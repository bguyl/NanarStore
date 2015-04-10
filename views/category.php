{% extends "layout.html.twig" %}

{% block title %}{{ name }}{% endblock %}

{% block content %}
{% for article in articles %}
<article>
    <h2><a class="articleTitle" href="/article/{{ article.id }}">{{ article.title }}</a></h2>
    <p>{{ article.description }}</p>
	<p>{{ article.category }}</p>
	<img src = '{{app.request.basepath}}/img/{{article.image}}'/>
	<br/> <p class="label label-primary"> {{article.price}}€ </p>
</article>
{% endfor %}
{% endblock %}
