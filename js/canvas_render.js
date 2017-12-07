var canvas=document.getElementById('c');
var context=canvas.getContext('2d');

console.log('canvas_render');

function ConvertToDec(){
  console.log("convert");
  var hexx = document.getElementById('xc').value;
  var decx = parseInt(hexx,16);
  // document.getElementById('rxc').value = decx;

  var hexy = document.getElementById('yc').value;
  var decy = parseInt(hexy,16);
  // document.getElementById('ryc').value = decy;

  var hexz = document.getElementById('zc').value;
  var decz = parseInt(hexz,16);
  // document.getElementById('rzc').value = decz;


  var hexw = document.getElementById('wc').value;
  var decw = parseInt(hexw,16);
  // document.getElementById('rwc').value = decw;

  /* User location */
  var x_pos = decx / 4;
  var y_pos = decy / 4;
  var z_pos = decz / 4;
  var typeadjust = z_pos + 17;
  context.beginPath();
  context.arc(x_pos,z_pos,3,0,Math.PI*2);
  context.strokeStyle='#FF00FF';
  context.fillStyle='#FF00FF';
  context.closePath();
  context.stroke();
  context.fill();
  context.textAlign='center';
  context.fillText('User Location',x_pos,typeadjust);

  console.log("add user");

}

/* */
context.font = "bold 10px sans-serif";
context.moveTo(20,20);
context.lineTo(20,100);
context.fillStyle = '#FFFFFF';
context.fillText('X',102,22);
context.moveTo(20,20);
context.lineTo(100,20);
context.fillStyle = '#FFFFFF';
context.fillText('Z',18,110);
context.lineWidth = 1;
context.strokeStyle = '#FFFFFF';
context.stroke();

for (var x = 0.5; x < 1024; x += 10) {
  context.moveTo(x, 0);
  context.lineTo(x, 1024);
}

for (var y = 0.5; y < 1024; y += 10) {
  context.moveTo(0, y);
  context.lineTo(1024, y);
}
context.moveTo(0,0);

context.strokeStyle = "#333333";
context.stroke();
context.font = "bold 10px sans-serif";

context.beginPath();
context.arc(512,512,5,0,Math.PI*2);
context.strokeStyle='#FFFFFF';
context.fillStyle='#FFFFFF';
context.closePath();
context.stroke();
context.fill();
context.textAlign='center';
context.fillText('GALAXY CENTER',512,530);
