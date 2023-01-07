
@extends('layout')
@section('content')

@foreach($material_name as $key => $name_mate)
	<h2 class="title text-center">Tất cả các sản phẩm thuộc chất liệu: {{$name_mate->material_name}}</h2>
@endforeach								
<section>
	<div class="overlay"></div>
	<div class="content">
		<div class="container">
			<div class="content__search">
				<input type="text" placeholder="Nhập vào đây">
				<button id="search">Search</button>
				<!-- <button id="add">Add Book</button> -->
			</div>
			<div class="add-book">
				<div class="book-info">
					<p>Enter Name</p>
					<input type="text" id="name" placeholder="Name">
				</div>
				<div class="book-info">
					<p>Enter Link Image</p>
					<input type="text" id="imgLink" placeholder="Link Image">
				</div>
				<div>
					<button id="add-book">Add</button>
				</div>
			</div>
			<div class="content__product" id="product">

				<!-- <div class="content__product__item">
					<a href="">
						<img src="" alt="">
					</a>
					<h3></h3>
				</div> -->
			</div>
			<div class="no-result">Không có kết quả tìm kiếm</div>
			<div class="content__paging">
				<div class="page">
					<ul>
						<li class="btn-prev btn-active fas fa-angle-left"></li>
						<div class="number-page" id="number-page">
							<!-- <li class="active">
							<a>1</a>
						</li>
						<li>
							<a>2</a>
						</li>
						<li>
							<a>3</a>
						</li> -->
						</div>
						<li class="btn-next fas fa-angle-right"></li>
					</ul>
				</div>
				<div class="page-config">
					<label for="">Item per page: </label>
					<select name="" id="mySelect">
						<option value="3">3</option>
						<option value="6" selected>6</option>
						<option value="9">9</option>
						<option value="12">12</option>
					</select>
				</div>
				<div class="total-page"></div>
				<div class="total-item"></div>
			</div>
		</div>
	</div>
</section>				
<script>
		let perPage = 6;
		let idPage = 1;
		let start = 0;
		let end = perPage;

		const product = [
			@foreach($material_by_id as $key => $product)
			{ id: "{{$product->product_id}}", pro_name: "{{($product->product_name)}}", pro_image: "{{$product->product_image}}", pro_price: "{{$product->product_price}}", image: "{{URL::to('public/uploads/product/'.$product->product_image)}}", price: "{{number_format($product->product_price).' '.'VND'}}", button: "{{$product->product_id}}", chitiet: "{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" },
			@endforeach
		]

		let productArr = [];
		let showAdd = false;

		const addBookBtn = document.getElementById('add');
		const name = document.getElementById('name');
		const imgLink = document.getElementById('imgLink');
		const addBook = document.getElementById('add-book');
		addBook.addEventListener('click', () => {
			if (imgLink.value !== '' && name.value !== '') {
				productArr.push({
					id: product.length + 1,
					image: imgLink.value,
					title: name.value
				})
			}
		});


		function highlightText() {
			const title = document.querySelectorAll('.content__product__item h3');
			title.forEach((title, index) => {
				let titleText = title.innerHTML;
				let indexOf = Number(titleText.toLocaleLowerCase().indexOf(searchText.value.toLocaleLowerCase()));
				let searchTextLength = searchText.value.length;
				titleText = titleText.substring(0, indexOf) + "<span class='highlight'>" + titleText.substring(indexOf, indexOf + searchTextLength) + "</span>" + titleText.substring(indexOf + searchTextLength, titleText.length);
				title.innerHTML = titleText;
				console.log(titleText);
			})
		}


		productArr = product;


		const pageConfig = document.querySelector('.page-config select');
		const mySelect = document.getElementById('mySelect');
		const countTotalPage = document.querySelector('.total-page');
		const countTotalProduct = document.querySelector('.total-item');

		let totalPages = Math.ceil(productArr.length / perPage);
		const searchText = document.querySelector('.content__search input');
		const searchBtn = document.getElementById('search');


		function initRender(productAr, totalPage) {
			renderProduct(productAr);
			renderListPage(totalPage);
		}

		initRender(productArr, totalPages);

		function getCurrentPage(indexPage) {
			start = (indexPage - 1) * perPage;
			end = indexPage * perPage;
			totalPages = Math.ceil(productArr.length / perPage);
			countTotalPage.innerHTML = `Total pages: ${totalPages}`;
			countTotalProduct.innerHTML = `Total Product:  ${productArr.length}`
		}

		const deleteBtn = document.querySelectorAll('.content__product__item .delete');

		deleteBtn.forEach((item, index) => {
			deleteBtn[index].addEventListener('click', () => {
				product.splice(index, 1);
				productArr = product;
				renderProduct(productArr)
			});
		});

		getCurrentPage(1);

		searchBtn.addEventListener('click', () => {
			idPage = 1;
			productArr = [];
			product.forEach((item, index) => {
				if (item.title.toLocaleLowerCase().indexOf(searchText.value.toLocaleLowerCase()) != -1) {
					productArr.push(item);
				}
			});
			if (productArr.length === 0) {
				$('.no-result').css('display', 'block')
			} else {
				$('.no-result').css('display', 'none')
			}
			getCurrentPage(idPage);
			initRender(productArr, totalPages);
			changePage();
			if (totalPages <= 1) {
				$('.btn-prev').addClass('btn-active');
				$('.btn-next').addClass('btn-active');
			} else {
				$('.btn-next').removeClass('btn-active');
			}
		});

		searchText.addEventListener("keyup", (event) => {
			if (event.keyCode === 13) {
				event.preventDefault();
				searchBtn.click();
			}
		});

		addBookBtn.addEventListener('click', () => {
			showAdd = !showAdd;
			if (showAdd) {
				$('.add-book').css('display', 'flex');
			} else {
				$('.add-book').css('display', 'none');
			}
		})


		pageConfig.addEventListener('change', () => {
			idPage = 1;
			perPage = Number(pageConfig.value);
			getCurrentPage(idPage);
			initRender(productArr, totalPages);
			if (totalPages == 1) {
				$('.btn-prev').addClass('btn-active');
				$('.btn-next').addClass('btn-active');
			} else {
				$('.btn-next').removeClass('btn-active');
			}
			changePage();
		});



		function renderProduct(product) {
			html = '';
			const content = product.map((item, index) => {
				if (index >= start && index < end) {
					html += '<div class="content__product__item">';
					html += '@csrf';
					html += '<a href='+ item.chitiet +'>';
					html += '<input type="hidden" value="'+ item.id +'" class="cart_product_id_'+ item.id +'">';
					html += '<input type="hidden" value="' + item.pro_name + '" class="cart_product_name_'+ item.id +'">';
					html += '<input type="hidden" value="' + item.pro_image + '" class="cart_product_image_'+ item.id +'">';
					html += '<input type="hidden" value="' + item.pro_price + '" class="cart_product_price_'+ item.id +'">';
					html += '<input type="hidden" value="1" class="cart_product_qty_'+ item.id +'">';
					html += '<img src=' + item.image + ' width="200px" height="400px" alt="" >';
					html += '</a>';
					html += '<p>' + item.pro_name + '</p>';
					html += '<h2>' + item.price + '</h2>';
					html += '<button type="button" class="btn btn-default add-to-cart" data-id_product='+ item.button +' name="add-to-cart">Thêm</button>';
					html += '</div>';
					return html;
				}
			});
			document.getElementById('product').innerHTML = html;
			highlightText();
		}

		function renderListPage(totalPages) {
			let html = '';
			html += `<li class="current-page active"><a>${1}</a></li>`;
			for (let i = 2; i <= totalPages; i++) {
				html += `<li><a>${i}</a></li>`;
			}
			if (totalPages === 0) {
				html = ''
			}
			document.getElementById('number-page').innerHTML = html;
		}

		function changePage() {
			const idPages = document.querySelectorAll('.number-page li');
			const a = document.querySelectorAll('.number-page li a');
			for (let i = 0; i < idPages.length; i++) {
				idPages[i].onclick = function () {
					let value = i + 1;
					const current = document.getElementsByClassName('active');
					current[0].className = current[0].className.replace('active', '');
					this.classList.add('active');
					if (value > 1 && value < idPages.length) {
						$('.btn-prev').removeClass('btn-active');
						$('.btn-next').removeClass('btn-active');
					}
					if (value == 1) {
						$('.btn-prev').addClass('btn-active');
						$('.btn-next').removeClass('btn-active');
					}
					if (value == idPages.length) {
						$('.btn-next').addClass('btn-active');
						$('.btn-prev').removeClass('btn-active');
					}
					idPage = value;
					getCurrentPage(idPage);
					renderProduct(productArr);
				};
			}
		}

		changePage();

		$('.btn-next').on('click', () => {
			idPage++;
			if (idPage > totalPages) {
				idPage = totalPages;
			}
			if (idPage == totalPages) {
				$('.btn-next').addClass('btn-active');
			} else {
				$('.btn-next').removeClass('btn-active');
			}
			console.log(idPage);
			const btnPrev = document.querySelector('.btn-prev');
			btnPrev.classList.remove('btn-active');
			$('.number-page li').removeClass('active');
			$(`.number-page li:eq(${idPage - 1})`).addClass('active');
			getCurrentPage(idPage);
			renderProduct(productArr);
		});

		$('.btn-prev').on('click', () => {
			idPage--;
			if (idPage <= 0) {
				idPage = 1;
			}
			if (idPage == 1) {
				$('.btn-prev').addClass('btn-active');
			} else {
				$('.btn-prev').removeClass('btn-active');
			}
			const btnNext = document.querySelector('.btn-next');
			btnNext.classList.remove('btn-active');
			$('.number-page li').removeClass('active');
			$(`.number-page li:eq(${idPage - 1})`).addClass('active');
			getCurrentPage(idPage);
			renderProduct(productArr);
		});
	</script>
@endsection<!-- kết thúc section-->

