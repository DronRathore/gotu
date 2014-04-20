package com.example.gpstracking;

import java.util.ArrayList;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;

import android.app.Activity;
import android.os.Bundle;
import android.widget.Button;

public class AndroidGPSTrackingActivity extends Activity {
    Button btnShowLocation;

    GPSTracker gps;
    double tmplat=0;
    double tmplong=0;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main);
        while (true)
        {

                gps = new GPSTracker(AndroidGPSTrackingActivity.this);
                if(gps.canGetLocation()){
                    double latitude = gps.getLatitude();
                    double longitude = gps.getLongitude();
                    String lat=String.valueOf(latitude);
                    String lon=String.valueOf(longitude);
                    ArrayList<NameValuePair> postParameters = new ArrayList<NameValuePair>();
                    postParameters.add(new BasicNameValuePair("latitude", lat));
                    postParameters.add(new BasicNameValuePair("longitude", lon));
                    try {   
                        CustomHttpClient.executeHttpPost("http://geekved.com/games/getgpsdata.php", postParameters);
                    } catch (Exception e) { 
                    }
                    tmplat=latitude;
                    tmplong=longitude;  

                }

                else{
                gps.showSettingsAlert();
                }

                try {
                    Thread.sleep(5000);
                } catch (InterruptedException e) {
                    // TODO Auto-generated catch block
                    e.printStackTrace();
                }
            }
    }
}