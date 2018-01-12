package com.xebia.research.header_checker_client.model;

import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;
import java.util.List;

public class RequestsList {
    @SerializedName("requests")
    private List<RequestObject> requests = new ArrayList<>();

    public List<RequestObject> getRequests() {
        return requests;
    }
}
