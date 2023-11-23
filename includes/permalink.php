<?php
function getLinkModule($slug)
{
  return 'dich-vu/' . $slug . '.html';
}

function getPreFixLinkService($module = '')
{
  if ($module == 'services') {
    return 'dich-vu';
  }
  return false;
}
