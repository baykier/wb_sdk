<?php
/**
 * Created by PhpStorm.
 * Author: Baykier<1035666345@qq.com>
 * Date: 2017/8/1
 * Time: 17:16
 */
use Wb\Client;
use Wb\Request;


require_once __DIR__ . '/vendor/autoload.php';

// const rsa private key
define('RSA_PRIVATE_KEY','
-----BEGIN RSA PRIVATE KEY-----
MIIEogIBAAKCAQEAz4pCNC7epGRpyjkuQzVgOQ07OUXN9Xr8mbeNqEniKsZHJfbX
YU7HZ8AqHNADNAqiMY30nsz1qPAXOjFVMChrI5fmKjvZZqih57r7AHi322qby5SI
6O5HbPyw2NmAB911cHE4lpQue7juHQ2m71KXJtwFqNhxwpWrPJkOucbwOF1iOgWe
tbTR46mwKEopk+yZwY0EYKN8RtTW62J9B0HrpLYMbWQusarHL5EHP6oI8W0Pcks8
ZrwejCZ8iJ2w8DnNcn/WYsLcWgkk1jjqhedxHqRb3wqWk6y26uR9uSryEWr+7PNN
I8ON37xH8AxA5jtZVBqj2d5pLe7LVTKN+virgwIDAQABAoIBAF4TMt1KnZtw9M84
yjKm4D4cNEtKzAhJPnVDUdAF5aI0DI417P1r41GxNqWm2LzfURQbX9YX3Ac/BZhY
QmA5Ag+5TBi61loFeJZ9GEfncJfiJErMwp6rW+8YP+Wb+cAW76QPfnIrK0Lj2fOL
e68iBegUdfBKZI6qn1sxmg42Ei/JuqnWvgmvlAzzzpxj94mo7Ko8WlPS1pX6qoiq
H20ukzt7alZDVnNY3r7mJPfnfuQoDRWr2RgNog8QRquFqzHMuAcizqUD9HrmoqZK
KLxAeIKMtossY6iIkN8xjv6sVnBmIjKpATXDAyrQbA1ATVC++BaeQozSz1tdZNGQ
amPftxkCgYEA/2t0FlVQJtq0bSTJ6N2j5Oz0W6ecIx7yE5QW3OoNvEGExXZ1jRVk
9wxqNN8zkH16MG9M6eZnAIgoed/lFTAb0clvcsd/Xouv1Y/7bJFfDpEP3DVuDnBZ
ypv9chELtRDCWzIEc043lFUUYBeAbjlLOMjlSA+QjkVAPRXe3t2GRJ8CgYEA0AL1
maRugvWEqSNP0rRMSdfEdPtWw3rlXqa8Bc55cLvEI15T46zFv2MK78vpDO92u+gJ
2sDfDEZYFTA8qlX55Pr7vlMNbfoZUeusBRLzY/dVA0UbLQ08PzgfbZ5SMU1iTpmH
o+hqzErqcUfSJT1HVDn6FgFKDaFHiCnteOiRqp0CgYABVTg33Z4bdcy3PRfopS9z
xGDKEafY7xJoU7+Cy53iu5zLwwB+CfyK5X+wYvHL8TuwAQSvu8oR0KQVbrutTqD2
iUyRlsTtY2E5hhTTzjZmxw8EISs/3Ao76nB6Jeifu0SoYSxwxZm4pnECx1yeNqJT
24iGxb4FYAsjxndxRkqrFQKBgCdCN7pMt3LOBcCqYnlg//j72R8/BIwWWM35aAks
g+0L8yO9vNV+mT/a4IiLkquXUnB6hcmclzxI1n0BQqHfYi+eUv8Dy8gS6M52TVwT
zI30cz4Pv+ZL1jAUVpIozFhzw3cUMO51ghqWlRLWPEo8+4Zg/ttCWQijhM2lJCWq
tztdAoGARHi05COrPo2NamX+fdB640JO5OiSYZpPVgrAGsV/xKBAgtun3YFB/Inv
pvijeusDfpMLH1k8UGXSpVrZ8Ofl2iKBGpVS5SlhnrCmTNvZZs1c3nPwtQzmFmRx
+szNK+oodEO7WZ08159k1eM+OCn5r9Q19qDVTWQ7hETNkx+3E8A=
-----END RSA PRIVATE KEY-----
');
// const rsa public key
define('RSA_PUBLIC_KEY','
-----BEGIN CERTIFICATE-----
MIIDVzCCAj+gAwIBAgIJALS2KUzSqqeDMA0GCSqGSIb3DQEBBQUAMEIxCzAJBgNV
BAYTAlhYMRUwEwYDVQQHDAxEZWZhdWx0IENpdHkxHDAaBgNVBAoME0RlZmF1bHQg
Q29tcGFueSBMdGQwHhcNMTcwNzEwMDgxNjQ4WhcNMjAwNzA5MDgxNjQ4WjBCMQsw
CQYDVQQGEwJYWDEVMBMGA1UEBwwMRGVmYXVsdCBDaXR5MRwwGgYDVQQKDBNEZWZh
dWx0IENvbXBhbnkgTHRkMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA
z4pCNC7epGRpyjkuQzVgOQ07OUXN9Xr8mbeNqEniKsZHJfbXYU7HZ8AqHNADNAqi
MY30nsz1qPAXOjFVMChrI5fmKjvZZqih57r7AHi322qby5SI6O5HbPyw2NmAB911
cHE4lpQue7juHQ2m71KXJtwFqNhxwpWrPJkOucbwOF1iOgWetbTR46mwKEopk+yZ
wY0EYKN8RtTW62J9B0HrpLYMbWQusarHL5EHP6oI8W0Pcks8ZrwejCZ8iJ2w8DnN
cn/WYsLcWgkk1jjqhedxHqRb3wqWk6y26uR9uSryEWr+7PNNI8ON37xH8AxA5jtZ
VBqj2d5pLe7LVTKN+virgwIDAQABo1AwTjAdBgNVHQ4EFgQUO6TwmonpEwCE35bL
5gKNJI6BsPYwHwYDVR0jBBgwFoAUO6TwmonpEwCE35bL5gKNJI6BsPYwDAYDVR0T
BAUwAwEB/zANBgkqhkiG9w0BAQUFAAOCAQEAQkOKmDTpsJJ/CBWriSZQm8ibwBN1
v9jNFL2qPjRM2nuoexYiJHt2eiOKzC+9H8x7yLFZV5WlZl986z4x2JC9kw6iE6Mw
bsINHxfcV0hxrdDmvPpuEvYLfW9Mcay35/NXELtsBJrrmuRTxnZJvzgFDrnHfkfL
Fkd31f1TdBR72qVbHGc9zyx7cyu6QDrLYDeHzFpo3AwMe7WWJYxtwoc0020pAw+t
LWno53nX2HoDN6r8fcw5oLJovnEyc2Y1LRRKL2zrK9zBfzZhA85+NDwQwK6EbII1
3pur3Q1+1+k+Ts6EmFCM9YXiz7XCFskCogWHOb7B+4QXlb3kCz9/C+K+Vw==
-----END CERTIFICATE-----
');

$client = new Client();
$client->setAppId('170040');
$client->setApiUrl('http://dev.wb_sdk/server.php');
$client->setRsaPrivateKey(RSA_PRIVATE_KEY);
$client->setMethod('queryOrderStatus');
$client->setBizData(array('order_num' => '1212'));
$resp = $client->send();

var_dump($resp);