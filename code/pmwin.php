<?php
/**
 * UCenter 应用程序开发 Example
 *
 * 开启短消息中心的 Example 代码
 * 使用到的接口函数：
 * pm()		必须，跳转到短消息中心的 URL
 * pm_checknew()	可选，用于全局判断是否有新短消息，返回 $newpm 变量
 */

//打开短消息中心的窗口
pm_location($Example_uid, $newpm);
exit;

?>