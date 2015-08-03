<div id = "new-property-dialog">
    <h3>Add new property</h3>
    <table>
        <tr>
            <td><h5 class = "lefted">Property</h5></td>
            <td class = "lefted">
                <select id ="NewPropName" onchange = "getPropDefault(this)">
                    <option disabled>----------</option>
                    <option disabled>The CrawlerTask module</option>
                    <option disabled>----------</option>
                    <option value = "HTTP_HEADERS">HTTP_HEADERS</option>
                    <option value = "HTTP_COOKIE">HTTP_COOKIE</option>
                    <option value = "STORE_HTTP_REQUEST">STORE_HTTP_REQUEST</option>
                    <option value = "HTTP_PROXY_HOST">HTTP_PROXY_HOST</option>
                    <option value = "HTTP_PROXY_PORT">HTTP_PROXY_PORT</option>
                    <option value = "MIME_TYPE_STORE_ON_DISK">MIME_TYPE_STORE_ON_DISK</option>
                    <option value = "HTTP_AUTH_NAME">HTTP_AUTH_NAME</option>
                    <option value = "HTTP_AUTH_PWD">HTTP_AUTH_PWD</option>
                    <option value = "HTTP_POST_FORM">HTTP_POST_FORM</option>
                    <option value = "EXTERNAL_FETCHER_URL">EXTERNAL_FETCHER_URL</option>
                    <option value = "HTML_RECOVER">HTML_RECOVER</option>
                    <option value = "MIME_TYPE_AUTO_DETECT">MIME_TYPE_AUTO_DETECT</option>
                    <option value = "PROCESSOR_NAME">PROCESSOR_NAME</option>
                    <option value = "STORE_COOKIES">STORE_COOKIES</option>
                    <option value = "AUTO_REMOVE_RESOURCES">AUTO_REMOVE_RESOURCES</option>
                    <option value = "AUTO_REMOVE_ORDER">AUTO_REMOVE_ORDER</option>
                    <option value = "AUTO_REMOVE_WHERE">AUTO_REMOVE_WHERE</option>
                    <option value = "HTTP_REDIRECTS_MAX">HTTP_REDIRECTS_MAX</option>
                    <option value = "HTML_REDIRECTS_MAX">HTML_REDIRECTS_MAX</option>
                    <option value = "URL_XPATH_LIST">URL_XPATH_LIST</option>
                    <option value = "RECRAWL_NO_ROOT_URLS">RECRAWL_NO_ROOT_URLS</option>
                    <option value = "COLLECT_POST_DATA">COLLECT_POST_DATA</option>
                    <option value = "URL_TEMPLATE_REGULAR">URL_TEMPLATE_REGULAR</option>
                    <option value = "URL_TEMPLATE_REALTIME">URL_TEMPLATE_REALTIME</option>
                    <option value = "URL_TEMPLATE_REGULAR_URLENCODE">URL_TEMPLATE_REGULAR_URLENCODE</option>
                    <option value = "URL_TEMPLATE_REALTIME_URLENCODE">URL_TEMPLATE_REALTIME_URLENCODE</option>
                    <option value = "RECRAWL_URL_AGE_EXPRESSION">RECRAWL_URL_AGE_EXPRESSION</option>
                    <option value = "RECRAWL_URL_UPDATE_STATUS">RECRAWL_URL_UPDATE_STATUS</option>
                    <option value = "RECRAWL_URL_UPDATE_TCDATE">RECRAWL_URL_UPDATE_TCDATE</option>
                    <option value = "RECRAWL_URL_UPDATE_CDATE">RECRAWL_URL_UPDATE_CDATE</option>
                    <option value = "RECRAWL_URL_UPDATE_UDATE">RECRAWL_URL_UPDATE_UDATE</option>
                    <option value = "ROBOTS_MODE">ROBOTS_MODE</option>
                    <option disabled>----------</option>
                    <option disabled>The ProcessorTask module</option>
                    <option disabled>----------</option>
                    <option value = "PROCESS_CTYPES">PROCESS_CTYPES</option>
                    <option value = "TIMEZONE">TIMEZONE</option>
                    <option value = "REFINE_TAGS">REFINE_TAGS</option>
                    <option value = "PROCESSOR_NAME">PROCESSOR_NAME</option>
                    <option value = "PROCESSOR_ALGORITHM">PROCESSOR_ALGORITHM</option>
                    <option value = "PROCESSOR_PROPERTIES">PROCESSOR_PROPERTIES</option>
                    <option value = "CONTENT_HASH">CONTENT_HASH</option>
                    <option value = "template">template</option>
                    <option value = "TEMPLATE_SELECTION_TYPE">TEMPLATE_SELECTION_TYPE</option>
                    <option disabled>----------</option>
                    <option disabled>Service inside</option>
                    <option disabled>----------</option>
                    <option value = "RECRAWL_PERIOD_MODE">RECRAWL_PERIOD_MODE</option>
                    <option value = "RECRAWL_PERIOD_MIN">RECRAWL_PERIOD_MIN</option>
                    <option value = "RECRAWL_PERIOD_MAX">RECRAWL_PERIOD_MAX</option>
                    <option value = "RECRAWL_PERIOD_STEP">RECRAWL_PERIOD_STEP</option>
                    <option value = "MODES_FLAG">MODES_FLAG</option>
                    <option value = "AGING_URL_TTL">AGING_URL_TTL</option>
                    <option value = "AGING_URL_CRITERION">AGING_URL_CRITERION</option>
                    <option value = "RECRAWL_DELETE">RECRAWL_DELETE</option>
                    <option value = "RECRAWL_DELETE_WHERE">RECRAWL_DELETE_WHERE</option>
                    <option disabled>----------</option>
                    <option disabled>The DB-task module</option>
                    <option disabled>----------</option>
                    <option value = "STATS_FREQ_ENABLED">STATS_FREQ_ENABLED</option>
                    <option value = "STATS_LOG_ENABLED">STATS_LOG_ENABLED</option>
                    <option value = "COUNTER_CRIT_RESOURCES">COUNTER_CRIT_RESOURCES</option>
                    <option value = "COUNTER_CRIT_CONTENTS">COUNTER_CRIT_CONTENTS</option>
                    <option value = "COUNTER_CRIT_CLURLS">COUNTER_CRIT_CLURLS</option>
                    <option value = "COUNTER_CRIT_NURLS">COUNTER_CRIT_NURLS</option>
                    <option value = "COUNTER_CRIT_DURLS">COUNTER_CRIT_DURLS</option>
                    <option value = "COUNTER_CRIT_CRURLS">COUNTER_CRIT_CRURLS</option>
                    <option value = "COUNTER_CRIT_PURLS">COUNTER_CRIT_PURLS</option>
                </select>
            </td>
    </table>
    <table>
        <tr>
            <td><h5>Value</h5></td>
        </tr>
        <tr>
            <td>
                <textarea id = "NewPropValue"></textarea>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td><input type = "button" value = "Add" onclick = "appendProp()"/></td>
            <td><input type = "button" value = "Close" onclick = "cancelNewProp()"/></td>
        </tr>
    </table>
    <input type = "hidden" name = "iterations" value = ""/>
        <input type = "hidden" name = "id" value = ""/>
</div>