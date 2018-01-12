package com.xebia.research.header_checker_client.net.service;

import com.google.gson.JsonObject;
import com.xebia.research.header_checker_client.model.Request;
import com.xebia.research.header_checker_client.model.RequestsList;
import com.xebia.research.header_checker_client.net.response.HeaderCheckerResponse;
import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.POST;

import java.util.ArrayList;

public interface RequestService {

    @POST("requests/batch")
    Call<HeaderCheckerResponse<ArrayList<Request>>> store(
            @Body RequestsList requestObject
    );

//    @POST("requests/batch")
//    Call<String> store(
//            @Body RequestsList requestObject
//    );
}
