package com.xebia.research.header_checker_client.model;

import com.google.gson.annotations.SerializedName;
import java.util.List;

public class RequestObject {
    @SerializedName("url")
    private String url;

    @SerializedName("method")
    private String method;

    @SerializedName("profile")
    private String profile;

    @SerializedName("requestHeaders")
    private List<RequestHeader> requestHeaders;

    @SerializedName("requestBodies")
    private List<RequestBody> requestBodies;

    // Setters
    public void setUrl(String url) {
        this.url = url;
    }

    public void setMethod(String method) {
        this.method = method;
    }

    public void setProfile(String profile) {
        this.profile = profile;
    }
}
