Stock Trade application

For setting up application : 
<ol>
<li>Download/Run composer</li>
<li>Make Stocks DB in MySql</li>
<li>Change .env file with: 
<ul><li>Configure DATABASE settings</li>
<li>Set CACHE_DRIVER to use database</li>
<li>Set QUEUE_CONNECTION to use database</li>
<li>Set API_KEY with Finnhub Api Key </li>
<li>Configure MAIL </li></ul>
<li>Run migrations</li>
<li>Run server</li>
<li>Run queue listener</li>
<li>Run schedule work</li>
<li>GET RICH</li>
</ol>
