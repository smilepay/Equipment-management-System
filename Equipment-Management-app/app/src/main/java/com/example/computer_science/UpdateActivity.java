package com.example.computer_science;

import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.text.method.ScrollingMovementMethod;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.google.zxing.integration.android.IntentIntegrator;
import com.google.zxing.integration.android.IntentResult;

import java.io.BufferedReader;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;

import java.net.HttpURLConnection;
import java.net.URL;
import java.sql.Date;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Locale;

import static android.support.constraint.Constraints.TAG;

public class UpdateActivity extends AppCompatActivity {

    private static String IP_ADDRESS = "192.168.30.141";
    private static String TAG = "phptest";

    EditText itemnumber,contents;
    String p_name,column,content;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.update);

        final TextView tv =  (TextView)findViewById(R.id.textView1);
        final TextView tv2 =  (TextView)findViewById(R.id.textView2);
        itemnumber = findViewById(R.id.itemnumber);
        contents = findViewById(R.id.change_content);

        Spinner s = (Spinner)findViewById(R.id.spinner1);
        s.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view,
                                       int position, long id) {
                tv.setText((CharSequence) parent.getItemAtPosition(position));
                p_name = tv.getText().toString();
            }
            @Override
            public void onNothingSelected(AdapterView<?> parent) {}
        });

        Spinner s2 = (Spinner)findViewById(R.id.spinner2);
        s2.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view,
                                       int position, long id) {
                tv2.setText((CharSequence) parent.getItemAtPosition(position));
                column = tv2.getText().toString();
                Toast.makeText(UpdateActivity.this, tv.getText(), Toast.LENGTH_SHORT).show();
            }
            @Override
            public void onNothingSelected(AdapterView<?> parent) {}
        });


        ImageButton update = findViewById(R.id.update);
        update.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String p_id = itemnumber.getText().toString();
                content = contents.getText().toString();
                System.out.println(p_name);
                System.out.println(p_id);
                System.out.println(column);
                System.out.println(content);


                if(column.equals("사용부서명")){
                    column = "dept_name";
                }
                if (column.equals("사용부서코드")){
                    column = "dept_code";
                }
                if (column.equals("책임자명")){
                    column = "leader";
                }
                if (column.equals("위치 내역")){
                    column = "location";
                }
                if (column.equals("변동사항 기록")){
                    column = "changes";
                }
                System.out.println(column);
                InsertData task = new InsertData();
                task.execute("http://" + IP_ADDRESS + "/update.php", p_name,p_id,column,content);
                Toast.makeText(UpdateActivity.this, "수정이 완료 되었습니다", Toast.LENGTH_SHORT).show();
            }
        });
    }
    class InsertData extends AsyncTask<String, Void, String>{
        ProgressDialog progressDialog;
        String errorString = null;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();

            progressDialog = ProgressDialog.show(UpdateActivity.this,
                    "Please Wait", null, true, true);
        }
        @Override
        protected String doInBackground(String... params) {

            String p_name = (String)params[1];
            String p_id = (String)params[2];
            String column = (String)params[3];
            String content = (String)params[4];

            String serverURL = (String)params[0];
            String postParameters = "p_name=" + p_name + "&p_id=" + p_id + "&column=" + column + "&content=" + content;

            try {
                URL url = new URL(serverURL);
                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();

                httpURLConnection.setReadTimeout(5000);
                httpURLConnection.setConnectTimeout(5000);
                httpURLConnection.setRequestMethod("POST");
                httpURLConnection.connect();

                OutputStream outputStream = httpURLConnection.getOutputStream();
                outputStream.write(postParameters.getBytes("UTF-8"));
                outputStream.flush();
                outputStream.close();

                int responseStatusCode = httpURLConnection.getResponseCode();
                Log.d(TAG, "POST response code - " + responseStatusCode);

                InputStream inputStream;
                if(responseStatusCode == HttpURLConnection.HTTP_OK) {
                    inputStream = httpURLConnection.getInputStream();
                }
                else{
                    inputStream = httpURLConnection.getErrorStream();
                }
                InputStreamReader inputStreamReader = new InputStreamReader(inputStream, "UTF-8");
                BufferedReader bufferedReader = new BufferedReader(inputStreamReader);

                StringBuilder sb = new StringBuilder();
                String line = null;

                while((line = bufferedReader.readLine()) != null){
                    sb.append(line);
                }
                bufferedReader.close();
                return sb.toString();
            } catch (Exception e) {

                Log.d(TAG, "InsertData: Error ", e);

                return new String("Error: " + e.getMessage());
            }
        }
    }
}