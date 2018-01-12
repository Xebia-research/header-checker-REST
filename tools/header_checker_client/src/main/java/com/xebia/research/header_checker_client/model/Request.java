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

//    @SerializedName("updated_at")
//    private Date updatedAt;

    public Integer getId() {
        return id;
    }

    public String getErrorMessage() {
        return errorMessage;
    }

    public Date getCreatedAt() {
        return createdAt;
    }

//    public Date getUpdatedAt() {
//        return updatedAt;
//    }
}
