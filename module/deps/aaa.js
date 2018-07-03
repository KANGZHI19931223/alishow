(function () {
	function person() {
		this.name;
		this.a = function () {
			
		}
	}
	p = new person();
	if (typeof define == 'function') {
		define(function () {
			return p;
		})
	}

})();