 HttpClient httpclient = new DefaultHttpClient();
            HttpPost httppost = new HttpPost("http://.../serverFile.php");
            JSONObject json = new JSONObject();


            TelephonyManager telephonyManager = (TelephonyManager)context.getSystemService(Context.TELEPHONY_SERVICE);
            String devid = telephonyManager.getDeviceId();

            String postData = "{\"request\":{\"type\":\"locationinfo\"},\"userinfo\":{\"latitude\":\""+latitude+"\",\"longitude\":\""+longitude+"\",\"devid\":\""+devid+"\"}}";




            try {  

                json.put("longitude", longitude);//place each of the strings as you did in postData method
                json.put("latitude", latitude);

                json.put("devid", devid);

                JSONArray postjson=new JSONArray();
                postjson.put(json);
                httppost.setHeader("json",json.toString());
                httppost.getParams().setParameter("jsonpost",postjson);     
                HttpResponse response = httpclient.execute(httppost);

                // for JSON retrieval:
                if(response != null)
                { 
                InputStream is = response.getEntity().getContent();
            BufferedReader reader = new BufferedReader(new InputStreamReader(is));
            StringBuilder sb = new StringBuilder();
            String line = null;
            try {
                while ((line = reader.readLine()) != null) {
                sb.append(line + "\n");
                }
                } catch (IOException e) {
                e.printStackTrace();
                } finally {
                try {
                is.close();
                } catch (IOException e) {
                e.printStackTrace();
                }
                }
                String jsonStr = sb.toString(); //take the string you built place in a string



                JSONObject rec = new JSONObject(jsonStr);
                String longitudecord = rec.getString("lon");
                    String latitudecord = rec.getString("lat");
                // ...
                }
                }catch (ClientProtocolException e) {
                // TODO Auto-generated catch block
                } catch (IOException e) {
                    // TODO Auto-generated catch block
                    } catch (JSONException e) {
                    // TODO Auto-generated catch block
                    e.printStackTrace();
                }