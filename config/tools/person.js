function person () {
	this.name;
	this.age;
	this.sayhi = function () {
		console.log(this.name + '今年' + this.age + '岁');
	}
}
p = new person();
console.log($('div').html());