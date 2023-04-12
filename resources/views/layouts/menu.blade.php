<!-- need to remove -->
<li class="nav-item menu-is-opening menu-open">
    <a href="#" class="nav-link {{ Route::is('teams.index') || Route::is('teams.create') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Teams
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: block;">
        <li class="nav-item">
            <a href="{{ route('teams.index') }}" class="nav-link {{ Route::is('teams.index') ? 'active' : route('teams.index') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All teams</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('teams.create') }}" class="nav-link {{ Route::is('teams.create') ? 'active' : route('teams.create') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create team</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item menu-is-opening menu-open">
    <a href="#" class="nav-link {{ Route::is('categories.index') || Route::is('categories.create') ? 'active' : '' }}">
        <i class="nav-icon fa fa-th" aria-hidden="true"></i>
        <p>
            Categories
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: block;">
        <li class="nav-item">
            <a href="{{ route('categories.index') }}" class="nav-link {{ Route::is('categories.index') ? 'active' : route('categories.index') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All categories</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('categories.create') }}" class="nav-link {{ Route::is('categories.create') ? 'active' : route('categories.create') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create category</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item menu-is-opening menu-open">
    <a href="#" class="nav-link {{ Route::is('questions.index') || Route::is('questions.create') ? 'active' : '' }}">
        <i class="nav-icon fa fa-question" aria-hidden="true"></i>
        <p>
            Questions
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: block;">
        <li class="nav-item">
            <a href="{{ route('questions.index') }}" class="nav-link {{ Route::is('questions.index') ? 'active' : route('questions.index') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All questions</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('questions.create') }}" class="nav-link {{ Route::is('questions.create') ? 'active' : route('questions.create') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create questions</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item menu-is-opening menu-open">
    <a href="#" class="nav-link {{ Route::is('answers.index') || Route::is('answers.create') ? 'active' : '' }}">
        <i class="nav-icon fa fa-info" aria-hidden="true"></i>
        <p>
            Answers
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: block;">
        <li class="nav-item">
            <a href="{{ route('answers.index') }}" class="nav-link {{ Route::is('answers.index') ? 'active' : route('answers.index') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All answers</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('answers.create') }}" class="nav-link {{ Route::is('answers.create') ? 'active' : route('answers.create') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create answers</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item menu-is-opening menu-open">
    <a href="#" class="nav-link {{ Route::is('competition.teams') ? 'active' : '' }}">
        <i class="nav-icon fas fa-arrow-circle-down" aria-hidden="true"></i>
        <p>
            Competition section
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: block;">
        <li class="nav-item">
            <a href="{{ route('competition.teams') }}" class="nav-link {{ Route::is('competition.teams') ? 'active' : route('competition.teams') }}">
                <i class="fas fa-play nav-icon"></i>
                <p>Start competition</p>
            </a>
        </li>
    </ul>
</li>
