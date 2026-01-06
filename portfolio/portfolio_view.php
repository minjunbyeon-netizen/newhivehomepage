<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '0');

// 프로젝트 루트 경로 설정
$base_path = '/01_work/hivemedia_homepage';

$CODE = isset($_REQUEST["CODE"]) ? htmlspecialchars($_REQUEST["CODE"]) : '';
?>
<!doctype html>
<html lang="ko" data-theme="light">

<head>
	<meta charset="utf-8">
	<title>하이브미디어 포트폴리오 | 프로젝트 상세</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta property="og:title" content="하이브미디어 - PORTFOLIO" />
	<meta property="og:description" content="하이브미디어 포트폴리오" />
	<meta property="og:image" content="../assets/img/orimage.png" />

	<link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicon/apple-icon-180x180.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png" />
	<link rel="stylesheet" href="../assets/css/all.css">
	<script src="//code.jquery.com/jquery-latest.min.js"></script>
	<script src="../assets/js/common.js" defer=""></script>
	<script src="../assets/js/components.js" defer=""></script>

	<style>
		body,
		.Wrap {
			background: #fff !important;
		}

		.portfolio-con.view-con {
			min-height: 100vh;
			padding: 80px 0;
		}

		.view-con .sub-top {
			padding: 60px 5%;
			background: #f8f8f8;
		}

		.view-con .sub-top .inner {
			max-width: 1200px;
			margin: 0 auto;
		}

		.view-con .path ul {
			display: flex;
			gap: 10px;
			align-items: center;
		}

		.view-con .path li {
			font-size: 13px;
			color: #666;
		}

		.view-con .sub-text h2 {
			font-size: 36px;
			font-weight: 700;
			margin-top: 20px;
		}

		.view-con .conbody {
			max-width: 1200px;
			margin: 0 auto;
			padding: 60px 5%;
		}

		.view-area .tit-info h4 {
			font-size: 28px;
			font-weight: 600;
			margin-bottom: 10px;
		}

		.view-area .tit-info .sort {
			color: #888;
			font-size: 14px;
		}

		.btn-line {
			margin-top: 40px;
			text-align: center;
		}

		.btn-list {
			display: inline-block;
			padding: 12px 40px;
			background: #333;
			color: #fff;
			text-decoration: none;
			border-radius: 4px;
			transition: background 0.3s;
		}

		.btn-list:hover {
			background: #111;
		}
	</style>
</head>

<body>
	<div class="Wrap">
		<div id="header-placeholder"></div>

		<main class="">
			<div class="portfolio-con view-con">

				<div class="sub-top">
					<div class="inner">
						<div class="path">
							<ul>
								<li class="home"><a href="<?php echo $base_path; ?>/"><img
											src="<?php echo $base_path; ?>/assets/img/sub/icon_home.png" alt=""></a>
								</li>
								<li><img src="<?php echo $base_path; ?>/assets/img/sub/icon_step_arrow.png" alt=""></li>
								<li>PORTFOLIO</li>
							</ul>
						</div>
						<div class="sub-text">
							<h2>Our <i>Portfolio</i></h2>
							<p>The best experience, the best quality.</p>
						</div>
					</div>
				</div>

				<div class="conbody">
					<div class="contents">
						<div class="view-area">
							<div class="tit-info">
								<h4>Portfolio Item</h4>
								<p class="sort">Category</p>
							</div>
							<div class="overview">
								<div class="image">
									<!-- Firebase에서 이미지 로드 -->
								</div>
							</div>

							<div class="btn-line">
								<a href="<?php echo $base_path; ?>/portfolio/portfolio.php" class="btn btn-list">목록</a>
							</div>
						</div>
					</div>
				</div>

			</div>
		</main>

		<div id="footer-placeholder"></div>
	</div>
</body>

</html>