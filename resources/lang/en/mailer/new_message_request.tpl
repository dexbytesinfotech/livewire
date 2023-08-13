{{ header }}

<p>Hi Admin!</p>
<p> Your recieved a new message -: #{{ order_number }}  </p>
<br>
<div style="margin-top:5px">
<span><b>Title</b> -: {{msg_title}}</span><br>
<span><b>Message</b> -: {{ msg_body }} </span>
</div>
<br>
{{ footer }}
