function scroller(el, duration) {
    if(this.criticalSection) {
        return false;
    }
 
    if((typeof el != 'object') || (typeof el.href != 'string')) {
        return true;
    }
 
    var address = el.href.split('#');
    if (address.length < 2) {
        return true;
    }
    address = address[address.length-1];
    console.log(address);
    el = 0;
    el = ge(address);

    if (el === 0) {
        return true;
    }

 
    this.stopX = 0;
    this.stopY = 0;
    do {
        this.stopX += el.offsetLeft;
        this.stopY += el.offsetTop;
    } while (el = el.offsetParent);
 
    this.startX = document.documentElement.scrollLeft || window.pageXOffset || document.body.scrollLeft;
    this.startY = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
 
    this. stopX = this.stopX - this.startX;
    this.stopY = this.stopY - this.startY;
 
    if ( (this.stopX == 0) && (this.stopY == 0) ) {
        return false;
    }
 
    this.criticalSection = true;

    this.duration = (typeof duration == 'undefined') ? 500 : duration;

    var date = new Date();
    this.start = date.getTime();
    this.timer = setInterval(function() {
        var date = new Date();
        var X = (date.getTime() - this.start) / this.duration;

        if (X > 1) {
            X = 1;
        }

        var Y = ((-Math.cos(X*Math.PI)/2) + 0.5);
 
        cX = Math.round(this.startX + this.stopX*Y);
        cY = Math.round(this.startY + this.stopY*Y);
 
        document.documentElement.scrollLeft = cX;
        document.documentElement.scrollTop = cY;
        document.body.scrollLeft = cX;
        document.body.scrollTop = cY;
 
        if (X == 1) {
            clearInterval( this.timer);
            this.criticalSection = false;
        }
    }, 10);
    return false;
}