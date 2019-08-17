package com.example.computer_science;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

import android.util.Log;
import android.widget.Toast;

public class PHPRequest {
    private URL url;

    public PHPRequest(String url) throws MalformedURLException { this.url = new URL(url); }

    private String readStream(InputStream in) throws IOException {
        StringBuilder jsonHtml = new StringBuilder();
        BufferedReader reader = new BufferedReader(new InputStreamReader(in, "UTF-8"));
        String line = null;

        while((line = reader.readLine()) != null)
            jsonHtml.append(line);

        reader.close();
        return jsonHtml.toString();
    }

    public String PhPtest(final String data1, final String data2,final String data3,final String data4,final String data5) {
        try {
            System.out.println("시작1");
            String postData = "pid=" + data1 + "&" + "r_studentID=" + data2 + "&" + "r_date=" + data3 + "return_date=" + data4+ "extension_check=" + data4;
            HttpURLConnection conn = (HttpURLConnection)url.openConnection();
            System.out.println("시작2");
            conn.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");
            conn.setRequestMethod("POST");
            System.out.println("시작3");
            conn.setReadTimeout(5000);
            conn.setConnectTimeout(5000);
            conn.setDoOutput(true);
            conn.setDoInput(true);
            System.out.println("시작33");
            conn.connect();
            System.out.println("시작4");
            OutputStream outputStream = conn.getOutputStream();
            System.out.println("시작10");
            outputStream.write(postData.getBytes("UTF-8"));
            System.out.println("시작5");
            outputStream.flush();
            outputStream.close();
            String result = readStream(conn.getInputStream());
            conn.disconnect();
            System.out.println("시작6");
            return result;
        }
        catch (Exception e) {
            Log.i("PHPRequest", "request was failed.");
            return null;
        }
    }
}