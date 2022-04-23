function varargout = decode(varargin)

gui_Singleton = 1;
gui_State = struct('gui_Name',       mfilename, ...
                   'gui_Singleton',  gui_Singleton, ...
                   'gui_OpeningFcn', @decode_OpeningFcn, ...
                   'gui_OutputFcn',  @decode_OutputFcn, ...
                   'gui_LayoutFcn',  [] , ...
                   'gui_Callback',   []);
if nargin & isstr(varargin{1})
    gui_State.gui_Callback = str2func(varargin{1});
end

if nargout
    [varargout{1:nargout}] = gui_mainfcn(gui_State, varargin{:});
else
    gui_mainfcn(gui_State, varargin{:});
end


% --- Executes just before decode is made visible.
function decode_OpeningFcn(hObject, ~, handles, varargin)

% Choose default command line output for decode
handles.output = hObject;

% Update handles structure
guidata(hObject, handles);

% --- Outputs from this function are returned to the command line.
function varargout = decode_OutputFcn(~, ~, handles)
% varargout  cell array for returning output args 
% hObject    handle to figure
% handles    structure with handles and user data

% Get default command line output from handles structure
varargout{1} = handles.output;


% --- Executes on button press in b1.
function b1_Callback(hObject, eventdata, handles)
t=[0:0.000125:.05];
fs=8000;
f1=697;f2=1209;
y1=.25*sin(2*pi*f1*t);
y2=.25*sin(2*pi*f2*t);
y=y1+y2;
sound(y,fs)
subdecode;
% --- Executes on button press in b2.
function b2_Callback(hObject, eventdata, handles)
t=[0:0.000125:.05];
fs=8000;
f1=697;f2=1336;
y1=.25*sin(2*pi*f1*t);
y2=.25*sin(2*pi*f2*t);
y=y1+y2;
sound(y,fs)
subdecode;
% --- Executes on button press in A.
function A_Callback(hObject, eventdata, handles)
t=[0:0.000125:.05];
fs=8000;
f1=697;f2=1663;
y1=.25*sin(2*pi*f1*t);
y2=.25*sin(2*pi*f2*t);
y=y1+y2;sound(y,fs)
subdecode;
% --- Executes on button press in b3.
function b3_Callback(hObject, eventdata, handles)
t=[0:0.000125:.05];
fs=8000;
f1=697;f2=1447;
y1=.25*sin(2*pi*f1*t);
y2=.25*sin(2*pi*f2*t);
y=y1+y2;sound(y,fs)
subdecode;
% --- Executes on button press in b4.
function b4_Callback(hObject, eventdata, handles)
t=[0:0.000125:.05];
fs=8000;
f1=770;f2=1209;
y1=.25*sin(2*pi*f1*t);
y2=.25*sin(2*pi*f2*t);
y=y1+y2;sound(y,fs)
subdecode;
% --- Executes on button press in b5.
function b5_Callback(hObject, eventdata, handles)
t=[0:0.000125:.05];
fs=8000;
f1=770;f2=1336;
y1=.25*sin(2*pi*f1*t);
y2=.25*sin(2*pi*f2*t);
y=y1+y2;sound(y,fs)
subdecode;
% --- Executes on button press in B.
function B_Callback(hObject, eventdata, handles)
t=[0:0.000125:.05];
fs=8000;
f1=770;f2=1633;
y1=.25*sin(2*pi*f1*t);
y2=.25*sin(2*pi*f2*t);
y=y1+y2;sound(y,fs)
subdecode;
% --- Executes on button press in b6.
function b6_Callback(hObject, eventdata, handles)
t=[0:0.000125:.05];
fs=8000;
f1=770;f2=1477;
y1=.25*sin(2*pi*f1*t);
y2=.25*sin(2*pi*f2*t);
y=y1+y2;sound(y,fs)
subdecode;
%--- Executes on button press in b7.
function b7_Callback(hObject, eventdata, handles)
t=[0:0.000125:.05];
fs=8000;
f1=852;f2=1209;
y1=.25*sin(2*pi*f1*t);
y2=.25*sin(2*pi*f2*t);
y=y1+y2;sound(y,fs)
subdecode;
% --- Executes on button press in b8.
function b8_Callback(hObject, eventdata, handles)
t=[0:0.000125:.05];
fs=8000;
f1=852;f2=1336;
y1=.25*sin(2*pi*f1*t);
y2=.25*sin(2*pi*f2*t);
y=y1+y2;sound(y,fs)
subdecode;
% --- Executes on button press in C.
function C_Callback(hObject, eventdata, handles)
t=[0:0.000125:.05];
fs=8000;
f1=852;f2=1633;
y1=.25*sin(2*pi*f1*t);
y2=.25*sin(2*pi*f2*t);
y=y1+y2;sound(y,fs)
subdecode;
% --- Executes on button press in b9.
function b9_Callback(hObject, eventdata, handles)
t=[0:0.000125:.05];
fs=8000;
f1=852;f2=1477;
y1=.25*sin(2*pi*f1*t);
y2=.25*sin(2*pi*f2*t);
y=y1+y2;sound(y,fs)
subdecode;
% --- Executes on button press in ba.
function ba_Callback(hObject, eventdata, handles)
t=[0:0.000125:.05];
fs=8000;
f1=941;f2=1209;
y1=.25*sin(2*pi*f1*t);
y2=.25*sin(2*pi*f2*t);
y=y1+y2;sound(y,fs)
subdecode;
% --- Executes on button press in b0.
function b0_Callback(hObject, eventdata, handles)
t=[0:0.000125:.05];
fs=8000;
f1=941;f2=1336;
y1=.25*sin(2*pi*f1*t);
y2=.25*sin(2*pi*f2*t);
y=y1+y2;sound(y,fs)
subdecode;
% --- Executes on button press in D.
function D_Callback(hObject, eventdata, handles)
t=[0:0.000125:.05];
fs=8000;
f1=941;f2=1633;
y1=.25*sin(2*pi*f1*t);
y2=.25*sin(2*pi*f2*t);
y=y1+y2;sound(y,fs)
subdecode;
% --- Executes on button press in bn.
function bn_Callback(hObject, eventdata, handles)
t=[0:0.000125:.05];
fs=8000;
f1=941;f2=1477;
y1=.25*sin(2*pi*f1*t);
y2=.25*sin(2*pi*f2*t);
y=y1+y2;sound(y,fs);
subdecode;

% --- Executes on button press in info.
function info_Callback(hObject, eventdata, handles)
msgbox('Muhammad Asif Ayub & Assad Ullah Khan & Arbab Shujaat Ahmad                                      DCSE UET, Peshawar','Info','help')

% --- Executes on button press in close.
function close_Callback(hObject, eventdata, handles)
close;