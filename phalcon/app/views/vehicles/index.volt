<div class="row">
    <div class="column">
        <nav aria-label="You are here:" role="navigation">
            <ul class="breadcrumbs">
                <li><a href="/">MotorDB</a></li>
                <li><span class="show-for-sr">Current: </span> Vehicles</li>
            </ul>
        </nav>
    </div>
</div>

<div class="row">
    <div class="column">
        <h1>Vehicles</h1>
    </div>
</div>

<div class="row">
    <div class="small-12 large-10 columns">
        <h2>Show me what you got</h2>
    </div>
    <div class="column">
        <div class="button-group align-right">
            {{ link_to("vehicles/new", "<i class='fi-plus'></i>", "class": "button") }}
        </div>
    </div>
</div>

{{ content() }}

{% for vehicle in page.items %}
    {% if loop.first %}
        <div class="row">
            <div class="column">
                <div class="callout white">
                    <div class="row small-up-1 medium-up-2 large-up-3">
    {% endif %}

        <div class="column">
            <img class="thumbnail" width="300px" src="{{ vehicle.image }}" />
            <div class="row">
                <div class="column">
                    <h5>{{ link_to("vehicles/view/" ~ vehicle.id, vehicle.getMakes().name ~ ' ' ~ vehicle.model) }}</h5>
                </div>
                <div class="columns button-group align-right">
                    {{ link_to("vehicles/edit/" ~ vehicle.id, '<i class="fi-pencil"></i>', "class": "label") }}
                    {{ link_to("vehicles/delete/" ~ vehicle.id, '<i class="fi-x"></i>', "class": "label") }}
                </div>
            </div>
            <p>£{{ "%.2f"|format(vehicle.price) }}</p>
        </div>

    {% if loop.last %}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="shrink columns button-group">
                {{ link_to("vehicles/search", '<i class="fi-rewind"></i>', "class": "button disabled") }}
                {{ link_to("vehicles/search?page=" ~ page.before, '<i class="fi-previous"></i>', "class": "button disabled") }}
            </div>
            <div class="column text-center">
                <span>{{ page.current }} of {{ page.total_pages }}</span>
            </div>
            <div class="shrink columns button-group align-right">
                {{ link_to("vehicles/search?page=" ~ page.next, '<i class="fi-next"></i>', "class": "button disabled") }}
                {{ link_to("vehicles/search?page=" ~ page.last, '<i class="fi-fast-forward"></i>', "class": "button disabled") }}
            </div>
        </div>

    {% endif %}

{% else %}
    <div class="row">
        <div class="columns">
            <div class="callout warning">No vehicles are recorded</div>
        </div>
    </div>
{% endfor %}

{{ form("vehicles/search") }}

<fieldset>

{% for element in form %}
    {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
{{ element }}
    {% else %}
<div class="row">
    <div class="column">
        {{ element.label(['class': 'control-label']) }}
        {{ element }}
    </div>
</div>
    {% endif %}
{% endfor %}

<div class="row">
    <div class="column">
        {{ submit_button("Search", "class": "button") }}
    </div>
</div>

</fieldset>

</form>
