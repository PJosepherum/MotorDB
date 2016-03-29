<div class="row column">
    <nav aria-label="You are here:" role="navigation">
        <ul class="breadcrumbs">
            <li><a href="/">MotorDB</a></li>
            <li><a href="/makes">Makes</a></li>
            <li><span class="show-for-sr">Current: </span> Edit</li>
        </ul>
    </nav>
</div>

{{ form("producttypes/save", 'role': 'form') }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("producttypes", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ submit_button("Save", "class": "btn btn-success") }}
    </li>
</ul>

{{ content() }}

<h2>Edit Product Types</h2>

<fieldset>

{% for element in form %}
    {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
{{ element }}
    {% else %}
<div class="form-group">
    {{ element.label(['class': 'control-label']) }}
    <div class="controls">
        {{ element }}
    </div>
</div>
    {% endif %}
{% endfor %}

</fieldset>

</form>
