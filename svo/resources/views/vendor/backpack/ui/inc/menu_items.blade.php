{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Posts" icon="la la-question" :link="backpack_url('post')" />
<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />
<x-backpack::menu-item title="Comments" icon="la la-question" :link="backpack_url('comments')" />
<x-backpack::menu-item title="Shopitems" icon="la la-question" :link="backpack_url('shopitem')" />
<x-backpack::menu-item title="Charities" icon="la la-question" :link="backpack_url('charity')" />
<x-backpack::menu-item title="Quizzes" icon="la la-question" :link="backpack_url('quiz')" />
<x-backpack::menu-item title="News" icon="la la-question" :link="backpack_url('news')" />
<x-backpack::menu-item title="Histories" icon="la la-question" :link="backpack_url('history')" />