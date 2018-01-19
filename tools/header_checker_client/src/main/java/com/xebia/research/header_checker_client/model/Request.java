package com.xebia.research.header_checker_client.model;

import com.google.gson.annotations.SerializedName;

import java.util.Date;

public class Request {

    @SerializedName("id")
    private Integer id;

    @SerializedName("error_message")
    private String errorMessage;

    @SerializedName("created_at")
    private Date createdAt;

    public Integer getId() {
        return id;
    }

    public String getErrorMessage() {
        return errorMessage;
    }

    public Date getCreatedAt() {
        return createdAt;
    }
}