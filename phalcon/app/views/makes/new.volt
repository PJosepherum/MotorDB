<div class="row column">
    <nav aria-label="You are here:" role="navigation">
        <ul class="breadcrumbs">
            <li><a href="/">MotorDB</a></li>
            <li><a href="/makes">Makes</a></li>
            <li><span class="show-for-sr">Current: </span> New</li>
        </ul>
    </nav>
</div>
{{ form("producttypes/create", "autocomplete": "off") }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("producttypes", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ submit_button("Save", "class": "btn btn-success") }}
    </li>
</ul>

{{ content() }}

<div class="center scaffold">
    <h2>Create product types</h2>

    <div class="clearfix">
        <label for="name">Name</label>
        {{ text_field("name", "size": 24, "maxlength": 70) }}
    </div>

</div>
</form>
