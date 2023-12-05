<?php
function getLinkModule($slug)
{
  return 'dich-vu/' . $slug . '.html';
}

function getPreFixLinkService($module = '')
{
  $prefixArr = [
    'services' => 'dich-vu',
    'pages' => 'thong-tin',
    'portfolios' => 'du-an',
    'blog_categories' => 'danh-muc',
    'blog' => 'blog'
  ];

  if (!empty($prefixArr[$module])) {
    return $prefixArr[$module];
  }

  return false;
}
