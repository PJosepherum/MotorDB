<div id="off-canvas-wrapper" class="off-canvas-wrapper">
    <div id="off-canvas-wrapper-inner" class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
        <div class="off-canvas position-left reveal-for-large" id="sidebar" data-off-canvas data-position="left">
            <div class="row userbox">
                {{ elements.getUser() }}
            </div>
            <div class="row">
                <div class="column">
                    {{ elements.getMenu() }}
                </div>
            </div>
        </div>
        <div class="off-canvas-content" data-off-canvas-content>
            <div class="top-bar">
                <div class="title-bar-left">
                    <button class="menu-icon hide-for-large" type="button" data-open="sidebar"></button>
                </div>
                <div class="title-bar-right">
                    <h1 class="title-bar-title">Neat</h1>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    {{ content() }}
                </div>
            </div>
            <div class="row">
                <div class="column">
                    {{ flash.output() }}
                </div>
            </div>
        </div>
    </div>
</div>