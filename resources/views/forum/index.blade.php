@extends('layouts.main')

@section('body-class'){{ 'forum' }}@stop

@section('content')
<link href="/assets/admin/vendor/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
      type="text/css"/>

	<div ng-app="productApp" data-ng-controller="forumController" class="ideaing-product" >
		<div class="top-bar">
			<div class="container">
				<span class="title">Advice</span>
			</div>
		</div>

		<div id="ideaing-community-container">
			<div class="container">
				<h2 class="text-center black-color">Ideaing Community</h2>
				<p class="text-center">Find out new stuff and also share your thoughts with the entire Ideaing universe.</p>
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2 col-md-12" id="forum-search-holder">
						<input class=" forum-text text-center" placeholder="Type any discussion">
                        <i class="m-icon m-icon--search-id"></i>
					</div>
				</div>
			</div>
		</div>
		<div id="question-content-container">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<img class="banner-img" src="{{asset('assets/images/forum/banner.png')}}">
					</div>
					<div class="col-lg-6 col-md-6">
						<p class="title">Post a question</p>
						<p>Get help your projects share your finds and show off your Before and After.</p>
						<div class="thread-question-holder">
							<div class="thread-question-icon-holder">
                                @if(!empty($userData['email']))
                                    <img src="https://s3-us-west-1.amazonaws.com/ideaing-01/120-product-56ce7066c0ef3-user-default 2.png" class="profile-photo">
                                @else
                                    <img src="{{isset($userData['medias'][0]['media_link']) ? $userData['medias'][0]['media_link'] : ""}}" alt="" class="profile-photo">
                                @endif
							</div>
							<div class="thread-question-text-holder">
								<input class="forum-text" ng-model="thread.title" placeholder="Example: What is the best way to renovate a house?">
							</div>
							<div class="clearfix"></div>
						</div>
						<br>
						<div>
		                    <div ng-class="['comment-edit-container', {'has-content': thread.content}]" ng-show="show_editor">
		                        <div text-angular ta-target-toolbars="toolbar" data-ng-model="thread.content" ta-disabled='disabled'
		                             name="description-editor"
		                             ta-text-editor-class="border-around ta-editor"
		                             ta-html-editor-class="border-around ta-editor">
		                        </div>
		                        <div text-angular-toolbar name="toolbar"></div>
		                    </div>
							<div ng-hide="show_editor">
								<textarea placeholder="Start typing the details ..." class="forum-text"
								ng-click="show_editor=1; focus_editor=true; focusEditor()" cols="" rows=""
								class=" ta-text ta-editor"></textarea>
							</div>
						</div>
						<br>
                        <div>
                            <div class="pull-left">
                                <select class="categories" ng-model="thread.category_id">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" >
                                            {{$category['title']}}
                                        </option>
                                        @foreach($category['sub_categories'] as $sub_category)
                                            <option value="{{$sub_category->id}}">--{{$sub_category->title}}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="pull-right">
                                @if(empty($userData['email']))
                                    <a class="btn btn-submit" href="#" data-toggle="modal" data-target="#myModal">Post</a>
                                @else
                                    <a class="btn btn-submit" ng-click="addThread()">Post</a>
                                @endif
                                
                            </div>
                            <div class="clearfix"></div>
                        </div>
					</div>
				</div>
			</div>
		</div>
		<div class="main-content-container">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 category-tab-container">
						<div class="row">
                            <?php $i=0; ?>
                            @foreach($categories as $category)
                                <div class="col-xs-3 ">
                                    <?php 
                                        switch($i){
                                            case "0":
                                                $class="smart-home";
                                                $iconClass="m-icon--smart-home";
                                                $categoryTitle="HOME";
                                            break;
                                            case "1":
                                                $class="smart-travel";
                                                $iconClass="m-icon--travel";
                                                $categoryTitle="TRAVEL";
                                            break;
                                            case "2":
                                                $class="smart-wearables";
                                                $iconClass="m-icon--wearables";
                                                $categoryTitle="BODY";
                                            break;
                                            case "3":
                                                $class="smart-video";
                                                $iconClass="m-icon--video";
                                                $categoryTitle="ENTERTAINMENT";
                                            break;
                                        }
                                    ?>
                                    <div style="cursor: pointer;" class="{{$class}}" ng-click="selectCategory({{$category->id}})">
                                        <div class="category-tab-icon-holder">
                                            <i class="m-icon {{$iconClass}}"></i> 
                                        </div>
                                        <div class="category-tab-title-holder">
                                            <span class="forum-small-title"><span class='hidden-xs hidden-sm hidden-md'>SMART</span> {{$categoryTitle}}</span> <br>
                                            <span id="thread-topics-{{$category->id}}">2077 Topics</span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                            @endforeach
						</div>
						<div class="row border-line-holder">
                            @foreach($categories as $category)
                                <div ng-class="['col-xs-3', {'active': '{{$category->id}}' == activeCategoryId }]" ></div>
                            @endforeach
						</div>
						<div class="row sub-category-container">
							<div class="col-xs-12">
								<button ng-repeat="subCategory in subCategories" ng-class="['btn', 'white-btn', {'active': subCategory.id==activeSubCategoryId}]" ng-click="selectSubCategory(subCategory.id)" >@{{subCategory.title}}</button>
							</div>
						</div>
					</div>
					<!--<div class="col-lg-3 col-md-3">
                        <div class="extra-container">
                            <div class="row">
                                <div class="col-xs-6">
                                    <img src="{{asset('assets/images/forum/apple.png')}}" alt=""><br>
                                    <span>85 topics</span>
                                </div>
                                <div class="col-xs-6">
                                    <img src="{{asset('assets/images/forum/nest.png')}}" alt=""><br>
                                    <span>41 topics</span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-6">
                                    <img src="{{asset('assets/images/forum/petnet.png')}}" alt=""><br>
                                    <span>41 topics</span>
                                </div>
                                <div class="col-xs-6">
                                    <a href="#">more</a>
                                </div>
                            </div>
                        </div>
                    </div>-->
				</div>
				<div class="row thread-list-container" >
                    <div class="col-lg-9 col-md-9 ">
                        <div class="row">
                            <div class="col-xs-5">
                                <span class="forum-small-title">NEWEST TOPIC</span>
                            </div>
                            <div class="col-xs-5">
                                <span class="forum-small-title">CATEGORY</span>
                            </div>
                            <div class="col-xs-2">
                                <span class="forum-small-title">VIEWS</span>
                            </div>
                        </div>
                        <div class="height-10"></div>
                        <div class="forum-list">
                            <div class="forum-list-row" ng-repeat="categoryThread in categoryThreads">
                                <div class="row">
                                    <div class="col-xs-5 forum-col">
                                        <span>
                                            <a class="pointer" href="/advice/thread/@{{categoryThread.id}}/@{{categoryThread.permalink}}">
                                                @{{categoryThread.title}}
                                            </a>
                                        </span>
                                    </div>
                                    <div class="col-xs-5 forum-col">
                                        <span >
                                            <span ng-if="categoryThread.parentCategoryTitle"> @{{categoryThread.parentCategoryTitle}} -> @{{categoryThread.categoryTitle}}</span>
                                            <span ng-if="!categoryThread.parentCategoryTitle"> @{{categoryThread.categoryTitle}}</span>
                                        </span>
                                    </div>
                                    <div class="col-xs-2 forum-col">
                                        <span>
                                            @{{categoryThread.viewCount}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <br><br>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div>
                            <span class="forum-small-title">MOST ACTIVE MEMBERS</span>
                        </div>
                        <div class="height-10"></div>
                        <div class="recent-member-list">
                            <div class="row" ng-repeat="key in [1,2,3,4,5,6,7]">
                                <div class="col-xs-12">
                                    <div class="member-list-row">
                                        <div class="member-image pull-left">
                                            <i class="m-icon m-icon--user"></i>
                                        </div>
                                        <div class="member-desc pull-left">
                                            <span>PETE MYERS STONE</span><br>
                                            <span>87% REPUTATION</span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
@stop