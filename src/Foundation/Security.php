<?php

namespace Premialabs\Foundation;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Security
{
  private $grants = [];
  private $navigator = [];

  // private function _populateNavigator()
  // {
  //   $this->navigator =
  //     [
  //       'text' => 'Main',
  //       'items' => [
  //         [
  //           'name' => 'projects',
  //           'text' => 'Manage Projects',
  //           'path' => '/projects/current',
  //           'items' => [
  //             [
  //               'name' => 'project.create',
  //               'text' => 'Create New Project',
  //               'path' => '/projects/create',
  //               'grant' => 'project.create'
  //             ],
  //             [
  //               'name' => 'project.view.current',
  //               'text' => 'Current Projects',
  //               'path' => '/projects/current',
  //               'grant' => 'project.view.current'
  //             ],
  //             [
  //               'name' => 'project.view.completed',
  //               'text' => 'Completed Projects',
  //               'path' => '/projects/completed',
  //               'grant' => 'project.view.completed'
  //             ],
  //             [
  //               'name' => 'project.view.all',
  //               'text' => 'All Projects',
  //               'path' => '/projects/all',
  //               'grant' => 'project.view.all'
  //             ]
  //           ]
  //         ],
  //         [
  //           'name' => 'users',
  //           'text' => 'Manage Users',
  //           'path' => '/users/all',
  //           'items' => [
  //             [
  //               'name' => 'user.create',
  //               'text' => 'Create New User',
  //               'path' => '/users/create',
  //               'grant' => 'user.create'
  //             ],
  //             [
  //               'name' => 'user.view.all',
  //               'text' => 'View All',
  //               'path' => '/users/all',
  //               'grant' => 'user.view.all'
  //             ]
  //           ]
  //         ],
  //         [
  //           'name' => 'search',
  //           'text' => 'Search',
  //           'path' => '/search/projects',
  //           'items' => [
  //             [
  //               'name' => 'project.create',
  //               'text' => 'Create New Project',
  //               'path' => '/projects/create',
  //               'grant' => 'project.create'
  //             ],
  //             [
  //               'name' => 'project.view.current',
  //               'text' => 'Current Projects',
  //               'path' => '/projects/current',
  //               'grant' => 'project.view.current'
  //             ],
  //             [
  //               'name' => 'project.view.completed',
  //               'text' => 'Completed Projects',
  //               'path' => '/projects/completed',
  //               'grant' => 'project.view.completed'
  //             ],
  //             [
  //               'name' => 'project.view.all',
  //               'text' => 'All Projects',
  //               'path' => '/projects/all',
  //               'grant' => 'project.view.all'
  //             ]
  //           ]
  //         ],
  //         [
  //           'name' => 'account',
  //           'text' => auth()->user()->name,
  //           'path' => '',
  //           'items' => [
  //             [
  //               'name' => 'account.settings',
  //               'text' => 'Settings',
  //               'path' => '/settings',
  //               'grant' => 'settings'
  //             ],
  //             [
  //               'name' => 'account.viewUserSessions',
  //               'text' => 'User session history',
  //               'path' => '/viewUserSessions',
  //               'grant' => 'auth.viewUserSessions'
  //             ]
  //           ]
  //         ]
  //       ]
  //     ];
  // }

  // private function _prepareNavItems($navs)
  // {
  //   $navigator = [];

  //   foreach ($navs as $nav_item) {
  //     if (array_key_exists('items', $nav_item)) {
  //       $nav_items = $this->_prepareNavItems($nav_item['items']);
  //       if (sizeof($nav_items) > 0) {
  //         $navigator[] = [
  //           'name' => $nav_item['name'],
  //           'text' => $nav_item['text'],
  //           'path' => $nav_item['path'],
  //           'items' => $nav_items
  //         ];
  //       }
  //     } else {
  //       if (in_array($nav_item['grant'], $this->grants)) {
  //         $navigator[] = [
  //           'name' => $nav_item['name'],
  //           'text' => $nav_item['text'],
  //           'path' => $nav_item['path'],
  //           'icon' => array_key_exists('icon', $nav_item) ? $nav_item['icon'] : ""
  //         ];
  //       }
  //     }
  //   }

  //   return $navigator;
  // }

  // private function getNavigator()
  // {
  //   $this->_populateNavigator();
  //   return [
  //     'text' => $this->navigator['text'],
  //     'items' => $this->_prepareNavItems($this->navigator['items'])
  //   ];
  // }

  // public function fetchClientData()
  // {
  //   foreach (auth()->user()->grants as $grant) {
  //     $this->grants[] = $grant['code'];
  //   }

  //   return [
  //     'navs' => $this->getNavigator()
  //   ];
  // }

  // public function getInfo()
  // {
  //   foreach (auth()->user()->grants as $grant) {
  //     $this->grants[] = $grant['code'];
  //   }

  //   return [
  //     'user' => auth()->user(),
  //     'permissions' => $this->grants
  //   ];
  // }
}
