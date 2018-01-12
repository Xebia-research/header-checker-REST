package com.xebia.research.header_checker_client.net.response;

import com.google.gson.annotations.SerializedName;

public class HeaderCheckerResponse<T> {

    @SerializedName("data")
    private T Data;

    public T getData() {
        return Data;
    }
}
