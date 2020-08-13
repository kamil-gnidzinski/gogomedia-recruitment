# gogomedia-recruitment

# Installation and configuration
  Those fields needs to be set up in .enx.local
  - MAILER_DSN used for report sending
  - DATABASE_URL db connection
  - REPORT_MAIL mail on which reports will be sent
  
  db can be populated using migrations and fixtures.
  
# Features
   - list of data with search form : /generator/data/search
   - API data insert endpoint /api/generator/data 
   - Example api request body:
          {
	          "generatorID": "1",
	          "measurementTime": "2020-01-02 01:01:02.3245",
	          "currentPower": "300"
          }
  # Report 
    Report is split in three sections (MAILER_DSN and REPORT_MAIL must be conficured in .env.local for this section to work)
      - app:generate-hourly-report command which prepares data for daily report and saves it into database
      - app:generate-daily-report command which prepares report and queues message to be sent
      - php bin/console messenger:consume async -vv set ups workes who consume queued message 
    
