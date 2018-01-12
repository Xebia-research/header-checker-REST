package com.xebia.research.header_checker_client.model;

import com.google.gson.annotations.SerializedName;

public class RequestBody {

    @SerializedName("key")
    private String key;

    @SerializedName("value")
    private String value;
}
