package com.xebia.research.header_checker_client.operations;

import java.io.*;

import java.io.FileNotFoundException;
import java.util.ArrayList;

import com.google.gson.Gson;
import com.xebia.research.header_checker_client.model.Request;
import com.xebia.research.header_checker_client.model.RequestsList;
import com.xebia.research.header_checker_client.net.Connectivity;
import com.xebia.research.header_checker_client.net.response.HeaderCheckerResponse;
import retrofit2.Response;

public class JSONReader {

    public static RequestsList getRequestsList(String filePath){
        BufferedReader json = null;
        try {
            json = new BufferedReader(new FileReader(filePath)); // "C:/Users/caspe/Desktop/RequestObject.json"
            System.out.println(json.toString());

            return Connectivity.getGson().fromJson(json,  RequestsList.class);
        } catch (FileNotFoundException e) {
            e.printStackTrace();
            return new RequestsList();
        }
    }

    public static void storeJsonResponse(Response<HeaderCheckerResponse<ArrayList<Request>>> response, String outFile){
        try(FileWriter file = new FileWriter(outFile)){
            String data = Connectivity.getGson().toJson(response.body().getData());
            file.write(data);
            System.out.println("File created: " + outFile);
        } catch (IOException e) {
            e.getMessage();
        }
    }
}


