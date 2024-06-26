<div class="theme-setting-wrapper">
    <div id="settings-trigger"><i class="ti-settings"></i></div>
    <div id="theme-settings" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <p class="settings-heading">SIDEBAR SKINS</p>
        <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="mr-3 border img-ss rounded-circle bg-light"></div>Light</div>
        <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="mr-3 border img-ss rounded-circle bg-dark"></div>Dark</div>
        <p class="mt-2 settings-heading">HEADER SKINS</p>
        <div class="px-4 mx-0 color-tiles">
        <div class="tiles success"></div>
        <div class="tiles warning"></div>
        <div class="tiles danger"></div>
        <div class="tiles info"></div>
        <div class="tiles dark"></div>
        <div class="tiles default"></div>
        </div>
    </div>
    </div>
    <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
            </li>
        </ul>
    <div class="tab-content" id="setting-content">
        <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="px-3 mb-0 add-items d-flex">
                <form class="form w-100">
                <div class="form-group d-flex">
                    <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                    <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
                </form>
            </div>
            <div class="px-3 list-wrapper">
                <ul class="d-flex flex-column-reverse todo-list">
                <li>
                    <div class="form-check">
                    <label class="form-check-label">
                        <input class="checkbox" type="checkbox">
                        Team review meeting at 3.00 PM
                    </label>
                    </div>
                    <i class="remove ti-close"></i>
                </li>
                <li>
                    <div class="form-check">
                    <label class="form-check-label">
                        <input class="checkbox" type="checkbox">
                        Prepare for presentation
                    </label>
                    </div>
                    <i class="remove ti-close"></i>
                </li>
                <li>
                    <div class="form-check">
                    <label class="form-check-label">
                        <input class="checkbox" type="checkbox">
                        Resolve all the low priority tickets due today
                    </label>
                    </div>
                    <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                    <div class="form-check">
                    <label class="form-check-label">
                        <input class="checkbox" type="checkbox" checked>
                        Schedule meeting for next week
                    </label>
                    </div>
                    <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                    <div class="form-check">
                    <label class="form-check-label">
                        <input class="checkbox" type="checkbox" checked>
                        Project review
                    </label>
                    </div>
                    <i class="remove ti-close"></i>
                </li>
                </ul>
            </div>
            <h4 class="px-3 mt-5 mb-0 text-muted font-weight-light">Events</h4>
            <div class="px-3 pt-4 events">
                <div class="mb-2 wrapper d-flex">
                <i class="mr-2 ti-control-record text-primary"></i>
                <span>Feb 11 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
                <p class="mb-0 text-gray">The total number of sessions</p>
            </div>
            <div class="px-3 pt-4 events">
                <div class="mb-2 wrapper d-flex">
                <i class="mr-2 ti-control-record text-primary"></i>
                <span>Feb 7 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                <p class="mb-0 text-gray ">Call Sarah Graves</p>
            </div>
        </div>
        <!-- To do section tab ends -->
        <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
                <p class="pt-0 pb-0 pl-3 mb-3 settings-heading border-top-0 border-bottom-0">Friends</p>
                <small class="pt-0 pb-0 pr-3 mb-3 settings-heading border-top-0 border-bottom-0 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
                <li class="list active">
                <div class="profile"><img src="{{ asset('images/faces/face1.jpg') }}" alt="image"><span class="online"></span></div>
                <div class="info">
                    <p>Thomas Douglas</p>
                    <p>Available</p>
                </div>
                <small class="my-auto text-muted">19 min</small>
                </li>
                <li class="list">
                <div class="profile"><img src="{{ asset('images/faces/face2.jpg') }}" alt="image"><span class="offline"></span></div>
                <div class="info">
                    <div class="wrapper d-flex">
                    <p>Catherine</p>
                    </div>
                    <p>Away</p>
                </div>
                <div class="mx-2 my-auto badge badge-success badge-pill">4</div>
                <small class="my-auto text-muted">23 min</small>
                </li>
                <li class="list">
                <div class="profile"><img src="{{ asset('images/faces/face3.jpg') }}" alt="image"><span class="online"></span></div>
                <div class="info">
                    <p>Daniel Russell</p>
                    <p>Available</p>
                </div>
                <small class="my-auto text-muted">14 min</small>
                </li>
                <li class="list">
                <div class="profile"><img src="{{ asset('images/faces/face4.jpg') }}" alt="image"><span class="offline"></span></div>
                <div class="info">
                    <p>James Richardson</p>
                    <p>Away</p>
                </div>
                <small class="my-auto text-muted">2 min</small>
                </li>
                <li class="list">
                <div class="profile"><img src="{{ asset('images/faces/face5.jpg') }}" alt="image"><span class="online"></span></div>
                <div class="info">
                    <p>Madeline Kennedy</p>
                    <p>Available</p>
                </div>
                <small class="my-auto text-muted">5 min</small>
                </li>
                <li class="list">
                <div class="profile"><img src="{{ asset('images/faces/face6.jpg') }}" alt="image"><span class="online"></span></div>
                <div class="info">
                    <p>Sarah Graves</p>
                    <p>Available</p>
                </div>
                <small class="my-auto text-muted">47 min</small>
                </li>
            </ul>
        </div>
        <!-- chat tab ends -->
    </div>
</div>
