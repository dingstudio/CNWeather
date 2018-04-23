<?php
//判断城市数据文件是否存在
$cityList = dirname(__FILE__).'/CityList.xml';
if (!file_exists($cityList)) {
    exit('Could not found city list information file.');
}

//初始化DOM数据处理类
$dom = new DOMDocument();
//打开XML文件
$dom->load($cityList);
//获取所有省份节点
$province = $dom->getElementsByTagName('province');
//判断是否传入指定省份
if (!isset($_REQUEST['province'])) { //没有传入省份参数，则回显所有省份信息
    $provinceListInfo = array(
        'code'  =>  200,
        'message'   =>  '您没有指定省份信息，当前共有'.$province->length.'个省份信息。',
        'data'  =>  array(),
        'requestId' =>  date('YmdHis', time())
    );
    for ($i = 0; $i < $province->length; $i++) {
        array_push($provinceListInfo['data'], $province[$i]->getAttribute('name'));
    }
    exit(json_encode($provinceListInfo));
}
for ($i = 0; $i < $province->length; $i++) { //当传入province参数时，遍历所有省份信息并选中目标
    if ($province[$i]->getAttribute('name') == $_REQUEST['province']) {
        $province_id = $province[$i]->getAttribute('id');
        $province_count = $i;
    }
}
if (!isset($province_count)) { //若指定省份节点未成功获取则给予截断报错
    exit('您所提供的省份信息有误，无法通过核验。');
}
$city = $province[$province_count]->getElementsByTagName('city'); //获取所有地级市节点
if (!isset($_REQUEST['city'])) { //没有传入地级市参数，则回显所有地级市信息
    $cityListInfo = array(
        'code'  =>  200,
        'message'   =>  '您没有指定地级市信息，当前共有'.$city->length.'个地级市信息。',
        'data'  =>  array(),
        'requestId' =>  date('YmdHis', time())
    );
    foreach ($city as $citys) {
        array_push($cityListInfo['data'], $citys->getAttribute('name'));
    }
    exit(json_encode($cityListInfo));
}
for ($i = 0; $i < $city->length; $i++) { //当传入city参数时，遍历所有地级市信息并选中目标
    if ($city[$i]->getAttribute('name') == $_REQUEST['city']) {
        $city_id = $city[$i]->getAttribute('id');
        $city_count = $i;
    }
}
if (!isset($city_count)) { //若指定地级市节点未成功获取则给予截断报错
    exit('您所提供的地级市信息有误，无法通过核验。');
}
$district = $city[$city_count]->getElementsByTagName('district'); //获取所有行政区划节点
if (!isset($_REQUEST['district'])) { //没有传入行政区划参数，则回显所有行政区划信息
    $districtListInfo = array(
        'code'  =>  200,
        'message'   =>  '您没有指定行政区划信息，当前共有'.$district->length.'个行政区划信息。',
        'data'  =>  array(),
        'requestId' =>  date('YmdHis', time())
    );
    foreach ($district as $districts) {
        array_push($districtListInfo['data'], $districts->getAttribute('name'));
    }
    exit(json_encode($districtListInfo));
}
for ($i = 0; $i < $district->length; $i++) { //当传入district参数时，遍历所有行政区划信息并选中目标
    if ($district[$i]->getAttribute('name') == $_REQUEST['district']) {
        $district_wid = $district[$i]->getAttribute('weatherCode');
        $district_count = $i;
    }
}
if (!isset($district_wid)) { //若指定行政区划节点未成功获取则给予截断报错
    exit('您所提供的行政区划信息有误，无法通过核验。');
}
echo file_get_contents('http://www.weather.com.cn/data/cityinfo/'.$district_wid.'.html');

//APIUrl: http://www.weather.com.cn/data/cityinfo/101210501.html 晴雨温度
//APIUrl: http://www.weather.com.cn/data/sk/101210501.html 风向风速湿度