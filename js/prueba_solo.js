<cfscript>
       myServer=cgi.SERVER_NAME;
       if (myServer==cgi.SERVER_NAME){
             WriteOutput(cgi.REMOTE_HOST);
             WriteOutput("<br>");
             WriteOutput(cgi.REMOTE_ADDR);
             }
       else{
       	            WriteOutput("Server does not exist");
             }
</cfscript>