package com.xebia.research.header_checker_client.operations;

import com.xebia.research.header_checker_client.model.Request;
import com.xebia.research.header_checker_client.model.RequestsList;
import com.xebia.research.header_checker_client.net.Connectivity;
import com.xebia.research.header_checker_client.net.response.HeaderCheckerResponse;
import com.xebia.research.header_checker_client.net.service.RequestService;
import retrofit2.Call;
import retrofit2.Response;
import retrofit2.Retrofit;

import java.io.IOException;
import java.util.ArrayList;

public class RequestOperations {

    // Make a storeRequestCall on the API
    public static void makeStoreRequestCall(RequestsList lstRequestObject, String outFile, String token) {
        Retrofit retrofit = Connectivity.getRetrofit(token);
        RequestService requestService = retrofit.create(RequestService.class);
        if (lstRequestObject.getRequests().size() > 0) {
            Call<HeaderCheckerResponse<ArrayList<Request>>> storeRequestCall = requestService.store(lstRequestObject);
            try {
                Response<HeaderCheckerResponse<ArrayList<Request>>> response = storeRequestCall.execute();
                if (response.isSuccessful()) {
                    System.out.println("Request Successful\n");
                    if (!outFile.equals("")) {
                        JSONReader.storeJsonResponse(response, outFile);
                    } else {
                        for (Request req : response.body().getData()) {
                            System.out.println("id: " + req.getId());
                            System.out.println("ErrorMessage: " + req.getErrorMessage());
                            System.out.println("CreatedAt: " + req.getCreatedAt() + "\n");
                        }
                    }
                } else {
                    System.out.println("Request Failure");
                    System.out.println(response.errorBody().string());
                }
                return;
            } catch (IOException e) {
                System.out.println("makeStoreRequestCall() Error: " + e.getMessage());
                return;
            }

        } else {
            System.out.println("Could not make Store Request\n");
            return;
        }
    }
}
