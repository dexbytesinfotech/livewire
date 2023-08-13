{{ header }}

<h2>Order number #{{order_number}}</h2>

<p>Hi {{ name }},</p>
<p> Your order current status is : {{ status }} </p>


<h3>Customer information</h3>

<p>Name : {{ name }} </p>
<p> Mobile : {{ mobile }}</p>

<br />

<p>If you have any question, please contact us via <a href="mailto:{{ site_admin_email }}">{{ site_admin_email }}</a></p>

{{ footer }}
