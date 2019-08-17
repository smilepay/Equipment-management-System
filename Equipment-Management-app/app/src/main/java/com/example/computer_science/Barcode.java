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
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageButton;
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

public class Barcode extends AppCompatActivity {

    private static String IP_ADDRESS = "192.168.30.141";
    private static String TAG = "phptest";
    private TextView mTextViewResult;

    TextView results;
    EditText itemnumber;
    String p_id,studentid,r_date,return_date;
    EditText dates;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.barcode);
        Intent intent = getIntent();
        final String p_name = intent.getStringExtra("item");

        //sults = findViewById(R.id.result);
        final Calendar cal = Calendar.getInstance();
        long now = System.currentTimeMillis();
        Date date = new Date(now);
        SimpleDateFormat sdfNow = new SimpleDateFormat("yyyy.MM.dd");
        String formatDate = sdfNow.format(date);

        dates = findViewById(R.id.editText2);
        dates.setText(formatDate);
        itemnumber = findViewById(R.id.itemnumber);
        ImageButton scan = findViewById(R.id.qrcode);
        scan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                new IntentIntegrator(Barcode.this).initiateScan();
            }
        });

        ImageButton check = findViewById(R.id.search);
        check.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getApplicationContext(), rent_check.class);
                intent.putExtra("p_id",studentid);
                startActivity(intent);
            }
        });

        ImageButton rent = findViewById(R.id.complete);
        rent.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                p_id = itemnumber.getText().toString();
                long now = System.currentTimeMillis();
                Date date = new Date(now);
                SimpleDateFormat sdf = new SimpleDateFormat("yyyy.MM.dd");
                r_date = sdf.format(date);

                InsertData task = new InsertData();
                task.execute("http://" + IP_ADDRESS + "/rent.php", p_id, p_name,"0",studentid,r_date,"0","null");
                Toast.makeText(Barcode.this, "대여가 완료 되었습니다", Toast.LENGTH_SHORT).show();
             }
        });

        ImageButton datebutton = findViewById(R.id.button7);
        datebutton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final Calendar cal = Calendar.getInstance();

                //Log.e(TAG, cal.get(Calendar.YEAR)+"");
                //Log.e(TAG, cal.get(Calendar.MONTH)+1+"");
                //Log.e(TAG, cal.get(Calendar.DATE)+"");
                //Log.e(TAG, cal.get(Calendar.HOUR_OF_DAY)+"");
                //Log.e(TAG, cal.get(Calendar.MINUTE)+"");

                return_date = cal.get(Calendar.YEAR) + "." + cal.get(Calendar.MONTH) + "." + cal.get(Calendar.DATE);

                //DATE PICKER DIALOG
                DatePickerDialog dialog = new DatePickerDialog(Barcode.this, new DatePickerDialog.OnDateSetListener() {
                    @Override
                    public void onDateSet(DatePicker datePicker, int year, int month, int date) {

                        String msg = String.format("%d 년 %d 월 %d 일", year, month + 1, date);
                        dates.setText(msg);
                        Toast.makeText(Barcode.this, msg, Toast.LENGTH_SHORT).show();
                    }
                }, cal.get(Calendar.YEAR), cal.get(Calendar.MONTH), cal.get(Calendar.DATE));
                //dialog.getDatePicker().setMaxDate(new Date().getTime());    //입력한 날짜 이후로 클릭 안되게 옵션
                dialog.show();
            }
        });
    }

    class InsertData extends AsyncTask<String, Void, String>{
        ProgressDialog progressDialog;
        String errorString = null;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();

            progressDialog = ProgressDialog.show(Barcode.this,
                    "Please Wait", null, true, true);
        }

        @Override
        protected String doInBackground(String... params) {

            String p_id = (String)params[1];
            String p_name = (String)params[2];
            String r_check = (String)params[3];
            String studentid = (String)params[4];
            String r_date = (String)params[5];
            String extension_check = (String)params[6];
            String extension_date = (String)params[7];

            String serverURL = (String)params[0];
            String postParameters = "p_id=" + p_id + "&p_name=" + p_name + "&r_check=" + r_check + "&r_studentID=" + studentid + "&r_date=" + r_date + "&extension_check=" + extension_check + "&extension_date=" + extension_date;

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
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data)
    {
        super.onActivityResult(requestCode, resultCode, data);

        IntentResult result = IntentIntegrator.parseActivityResult(requestCode, resultCode, data);

        studentid = result.getContents();
        studentid = studentid.substring(4,11);
    }
}
