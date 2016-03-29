<div class="row">
    <div class="column">
        <nav aria-label="You are here:" role="navigation">
            <ul class="breadcrumbs">
                <li><a href="/">MotorDB</a></li>
                <li><a href="/vehicles">Vehicles</a></li>
                <li><span class="show-for-sr">Current: </span> View</li>
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
        <h2>View vehicle</h2>
    </div>
    <div class="column">
        <div class="button-group align-right">
            {{ link_to("vehicles", "<i class='fi-arrow-left'></i>", "class": "button") }}
        </div>
    </div>
</div>

{{ content() }}

{% if vehicle %}
    <div class="row">
        <div class="column">
            <div class="callout white">
                <div class="row">
                    <div class="column">
                        <img class="thumbnail" width="300px" src="{{ vehicle.image }}" />
                    </div>
                    <div class="column">
                        <div class="row">
                            <div class="column">
                                <h5>{{ link_to("vehicles/view/" ~ vehicle.id, vehicle.getMakes().name ~ ' ' ~ vehicle.model) }}</h5>
                            </div>
                            <div class="columns button-group align-right">
                                {{ link_to("vehicles/edit/" ~ vehicle.id, '<i class="fi-pencil"></i>', "class": "label") }}
                                {{ link_to("vehicles/delete/" ~ vehicle.id, '<i class="fi-x"></i>', "class": "label") }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="column">
                                <table>
                                    <tr>
                                        <th>Price</th>
                                        <td>£{{ "%.2f"|format(vehicle.price) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Condition</th>
                                        <td>{{ vehicle.condition }}</td>
                                    </tr>
                                    <tr>
                                        <th>Colour</th>
                                        <td>{{ vehicle.colour }}</td>
                                    </tr>
                                    <tr>
                                        <th>Style</th>
                                        <td>{{ vehicle.style }}</td>
                                    </tr>
                                    <tr>
                                        <th>Year</th>
                                        <td>{{ vehicle.year }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
{% else %}
    <div class="row">
        <div class="columns">
            <div class="callout warning">No vehicles are recorded</div>
        </div>
    </div>
{% endif %}