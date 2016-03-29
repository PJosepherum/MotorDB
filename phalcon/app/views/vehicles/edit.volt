<div class="row">
    <div class="column">
        <nav aria-label="You are here:" role="navigation">
            <ul class="breadcrumbs">
                <li><a href="/">MotorDB</a></li>
                <li><a href="/vehicles">Vehicles</a></li>
                <li><span class="show-for-sr">Current: </span> Edit</li>
            </ul>
        </nav>
    </div>
</div>

<div class="row">
    <div class="column">
        <h1>Vehicles</h1>
    </div>
</div>

{{ content() }}

{{ form("vehicles/save", 'role': 'form') }}

    <div class="row">
        <div class="column">
            <h2>Edit</h2>
        </div>
        <div class="column button-group align-right">
            {{ link_to("vehicles", "<i class='fi-arrow-left'></i>", "class": "button") }}
        </div>
    </div>

    <fieldset>

        {% for element in form %}
            {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
                {{ element }}
            {% else %}
                <div class="row">
                    <div class="column">
                        {{ element.label() }}
                        {{ element }}
                    </div>
                </div>
            {% endif %}
        {% endfor %}

        <div class="row">
            <div class="column">
                {{ submit_button("Save", "class": "button success") }}
            </div>
        </div>

    </fieldset>

</form>