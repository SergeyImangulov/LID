# LID
## index.php
This file contains the main form fields, the data of which will subsequently be filled in the cloud version of Bitrix24 in the CRM section in LEAD.
In our case, 4 fields are filled in (2 of which are required).

## WriteToLog.php
This file contains a script responsible for sending data filled in on the site with certain fields.
 In addition to the main 4 filled fields, the "Source" field was also indicated in the code itself.

To connect this application, in our В24, in the "Market" section, select the "Add application" section 
in the upper right corner, select "Other" from the 5 main points, select "Outgoing webhook" there.
After the new window pops up, select the method in the "Query Generator" crm.lead.add, 
as a result of which we save our webhook and copy the generated **URL** link and paste it into our code, namely **$ queryUrl**

## style.css
This file sets the style for our form
