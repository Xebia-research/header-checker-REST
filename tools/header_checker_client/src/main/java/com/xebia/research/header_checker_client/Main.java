package com.xebia.research.header_checker_client;

import com.xebia.research.header_checker_client.model.RequestObject;
import com.xebia.research.header_checker_client.model.RequestsList;
import com.xebia.research.header_checker_client.operations.JSONReader;
import com.xebia.research.header_checker_client.operations.RequestOperations;

public class Main {
    // Arguments
    private static final String URL = "-url";               // Required with 'method' or only use 'filepath'
    private static final String METHOD = "-method";         // Required with 'URL' or only use 'filepath'
    private static final String PROFILE = "-profile";       // Required
    private static final String TOKEN = "-token";           // Required
    private static final String FILEPATH = "-file";         // Required without 'URL' && 'METHOD' && 'PROFILE'
    private static final String OUTFILE = "-outfile";       // Optional
    private static final String HELP = "-help";             // Help argument to show possible arguments

    public static void main(String[] args) {
        String filePath = "";
        String token = "";
        String url = "";
        String method = "";
        String outFile = "";
        String profile = "";

        // Read out user's arguments
        if (args.length > 0) {
            for (int i = 0; i < args.length; i++) {

                if (args[i].equals(FILEPATH)) {
                    filePath = args[i + 1];
                } else if (args[i].equals(TOKEN)) {
                    token = args[i + 1];
                } else if (args[i].equals(URL)) {
                    url = args[i + 1];
                } else if (args[i].equals(METHOD)) {
                    method = args[i + 1];
                } else if (args[i].equals(OUTFILE)) {
                    outFile = args[i + 1];
                } else if (args[i].equals(PROFILE)) {
                    profile = args[i + 1];
                } else if (args[i].equals(HELP)) {
                    showHelp();
                    return;
                }
            }

            if(!token.equals("")){
                if (!method.equals("") && !url.equals("") && !filePath.equals("")) {
                    System.out.println("Use only method with url, or only file");
                    return;
                } else if (!method.equals("") && !url.equals("")) {
                    // Create a list with one Request object. API only accepts lists
                    RequestsList lstRequestObject = new RequestsList();
                    RequestObject requestObject = new RequestObject();
                    requestObject.setUrl(url);
                    requestObject.setMethod(method.toUpperCase());
                    requestObject.setProfile(profile);
                    lstRequestObject.getRequests().add(requestObject);

                    RequestOperations.makeStoreRequestCall(lstRequestObject, outFile, token);
                } else if (!filePath.equals("")) {
                    RequestsList lstRequests = JSONReader.getRequestsList(filePath);
                    RequestOperations.makeStoreRequestCall(lstRequests, outFile, token);
                }
            }else {
                System.out.println("Token is required");
                return;
            }

        } else {
            System.out.println("\nArgum ents are required, use -help to see the options");
            return;
        }
    }

    private static void showHelp() {
        System.out.println("\nHelp: ");
        System.out.println(TOKEN + "\t \t<token> \t \t Token provided by Xebia team (Required)");
        System.out.println(URL + "\t \t<url> \t \t \t Url to preferred server (Required in combination with METHOD)");
        System.out.println(METHOD + "\t \t<METHOD> \t \t Preffered method to make api call with (GET, PUT, PATCH, POST etc.)");
        System.out.println(FILEPATH + "\t \t<filepath>\t \t Path to file of JSON format with url, method, requestHeaders[] and requestBodies[]");
        System.out.println(PROFILE + "\t<profile> \t \t Profile to use");
        System.out.println(OUTFILE + "\t<filepath> \t \t Preferred path to outputFile ");
    }
}
