{{ header }}

<h2>Order successfully!</h2>

<p>Hi {{ name }},</p>
<p>Thank you for purchasing our products, order #{{order_number}}</p>


<h3>Customer information</h3>

<p>{{ name }} - {{ mobile }}</p>

<br />

<p>If you have any question, please contact us via <a href="mailto:{{ site_admin_email }}">{{ site_admin_email }}</a></p>

{{ footer }}
