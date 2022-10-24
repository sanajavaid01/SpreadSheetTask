steps:
1. You need to create google sheet on google sheet app then you need to add configuration other you can get access of exsisting google sheet https://docs.google.com/spreadsheets/d/1m2ji-E7w8mujfM1ZClSsIKy-0c59IioPZJL2FVIIJ4Q/edit#gid=0
2.Following is the command for pushing data on google sheet:
syntax
    php spreadsheet read:xml <url> 
example:
    php spreadsheet read:xml "C:/coffee_feed.xml" 
3. for configuration of api credentials younhave to goto storage/credentials.json and update that file
