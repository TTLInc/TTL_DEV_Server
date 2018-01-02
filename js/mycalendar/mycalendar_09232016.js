var Project = {
    init: function() {
        this.initModules();
    },
    modules: [],
    initModules: function() {
        for (var module in Project.modules) {
            var id = module.replace(/([A-Z])/g, '-$1').toLowerCase();
            id = id.substring(0, 1) == '-' ? id.substring(1) : id;
            if ($('#' + id).length && typeof(this.modules[module].init) == 'function') {
                Project.modules[module].init($('#' + id));
            }
        }
    }
}
var count=0;	
Project.modules.customcalendar = {
    CalendarDate: '',
    CalendarStartDate: new Date(),
    CalendarEndDate: new Date(),
    CurrentDate: new Date(),
    htmlcode: '',
    dayfreetime: 0, /* This will be hour and minutes */
    timeslotgap: 30, /* This will be in minutes */
    timeslotrange: 16,/* This will be in hour */
    pastimecode: '#dbd9d9',
    defaultcolorcode: '#F3F1F1',//rgb(243, 241, 241)
    base_url: '',
    divcalendar:'',
    freeslotcode:'#84c022', //rgb(132, 192, 34)
    bookslotcode:'#e8bdbe',
    logintype: 'tutor',
    additionalprofileid: 0,
    slot_0_isopen: "0",
    slot_1_isopen: "0",
    slot_2_isopen: "0",
    requestslotcolorcode: '#cbecb0',
    requestedslotcolorcode: '#e8bdbe',
    confirmslotcolorcode: '#eac3c4',
    languageArray: "",
    uid: 0,
    init: function() {
        //console.log("testa");
    },
    mycalendersetting: function(idelement,calendardate_v,baseurl,logintypev,additionalprofileidv,languageArrayv,dropdowntype,uid)
    {
        Project.modules.customcalendar.setCalenderDate(calendardate_v);
        this.base_url = baseurl;
        this.divcalendar = idelement;
        this.logintype = logintypev;
        this.uid = uid;
        //console.log(this.uid);
        //console.log(languageArrayv);
        this.additionalprofileid = additionalprofileidv;
        this.languageArray = jQuery.parseJSON(languageArrayv);
        //console.log(this.languageArray + this.languageArray.morning);
        //console.log(this.CurrentDate);
        //console.log(calendardate_v);
        this.htmlcode="";
        $("#"+this.divcalendar).html(Project.modules.customcalendar.generatecode(dropdowntype));
        Project.modules.customcalendar.bindelement();
    },
    generatecode: function(dropdowntype)
    {
		//console.log("Generating calendar");
        //Project.modules.customcalendar.generateHeaderCalendar();
        this.htmlcode = this.htmlcode + Project.modules.customcalendar.generatePageHeaderCalendar();
        this.htmlcode = this.htmlcode + Project.modules.customcalendar.generateHeaderCalendar();
        this.htmlcode = this.htmlcode + Project.modules.customcalendar.generatetime();
        //this.htmlcode = this.htmlcode + 
        Project.modules.customcalendar.generatedata(0,'GetAll');
        /*if (dropdowntype == 1)
        {
            Project.modules.customcalendar.conversationtopicfromdbs();
        }*/
        //Project.modules.customcalendar.bindelement();
		//console.log(this.htmlcode);
        return this.htmlcode;
    },
    setCalenderDate: function(calendardate_v) {
        this.CalendarDate = new Date();
        if (Date.parse(calendardate_v))
        {
            //console.log("a");
            this.CalendarDate = new Date(calendardate_v); 
        }
        else
        {
            //console.log("f");
            this.CalendarDate = new Date(); 
        }
        //this.CalendarDate = new Date();
		//console.log(this.CalendarDate.getDay());
        //console.log(this.CalendarDate + " : getDay : " + this.CalendarDate.getDay() + " : " + this.CalendarDate.getDate());
		//return false;
        if (this.CalendarDate.getDay() != 0 && this.CalendarDate.getDay() != 6)
        {
            this.CalendarStartDate = new Date(this.CalendarStartDate.setTime(this.CalendarDate.getTime() - ((this.CalendarDate.getDay())*24*60*60*1000)));
            //this.CalendarEndDate = new Date(this.CalendarEndDate.setDate(this.CalendarStartDate.getDate() + 6));
			//alert(this.CalendarStartDate);
			
        }else if (this.CalendarDate.getDay() == 6){
			var td = new Date(); 
			var nextSunday= new Date(td.getFullYear(),td.getMonth(),td.getDate()+(7-td.getDay()))
			this.CalendarStartDate = nextSunday;
		}
        else
        {
            this.CalendarStartDate = new Date(this.CalendarDate);
            //this.CalendarEndDate = new Date(this.CalendarEndDate.setTime(this.CalendarDate.getTime() + ((c-1)*24*60*60*1000)));
        }
        //this.CalendarEndDate = new Date(this.CalendarEndDate.setDate(this.CalendarStartDate.getDate() + 6));
        this.CalendarEndDate = new Date(this.CalendarEndDate.setTime(this.CalendarStartDate.getTime() + ((6)*24*60*60*1000)));
        //console.log(this.CalendarStartDate + " : " + this.CalendarEndDate);
    },
    generateHeaderCalendar: function() {
        //console.log(this.CalendarStartDate + " : " + this.CalendarEndDate);
        tphtmlcode = '';
        caldate = new Date();
        for(c=0;c<7;c=c+1)
        {
            caldate = new Date(caldate.setTime(this.CalendarStartDate.getTime() + (c*24*60*60*1000)));
            tphtmlcode = tphtmlcode + '<div class="fc-sun fc-col0 fc-widget-header top-ttl" style="width: 78px;">' + this.formatdate(caldate,2) + '</div>';
        }
        tphtmlcode = this.getheaderfooter("header","",'','') + tphtmlcode + this.getheaderfooter("footer","",'','');
        return tphtmlcode;
    },
    generatePageHeaderCalendar: function() {
        tphtmlcode = '<div class="fc-header-left" style="width:100%;"><span id="pasttime" class="fc-button fc-button-prev fc-state-default fc-corner-left fc-corner-right" unselectable="on" style="-moz-user-select: none;float:left;margin:0px 0px 0px 20px;">\n\
            <span class="fc-icon fc-icon-left-single-arrow"></span>\n\
            </span><span class="fc-header-space" style="float:left;width:84%;">&nbsp;</span>\n\
            <span id="comingtime" class="fc-button fc-button-next fc-state-default fc-corner-left fc-corner-right" unselectable="on" style="-moz-user-select: none;float:left;margin:0px 20px 0px 0px;">\n\
            <span class="fc-icon fc-icon-right-single-arrow"></span></span>\n\
            <div class="fc-header-center" style="margin: 0 0 0 250px;display:none;"><span class="fc-header-title"><h2 style="font-size: 25px;">' + this.formatdate(this.CalendarStartDate,1)  + ' : ' + this.formatdate(this.CalendarEndDate,1) + '</h2></span></div></div>';
        return tphtmlcode;
    },
    formatdate: function(date_v,format)
    {
        dt = "";
        if (format == 1)
        {
            dt = date_v.getDate() + "-" + (date_v.getMonth() + 1) + "-" + date_v.getFullYear();
        }
        if (format == 2)
        {
            dt = (date_v.getMonth() + 1) + "/" + date_v.getDate() + "<br/>" + this.getweekday(date_v);
        }
        return dt;
    },
    getweekday: function(date_v)
    {
        var weekday = new Array(7);
        weekday[0] = this.languageArray.sun;
        weekday[1] = this.languageArray.mon;
        weekday[2] = this.languageArray.tue;
        weekday[3] = this.languageArray.wed;
        weekday[4] = this.languageArray.thu;
        weekday[5] = this.languageArray.fri;
        weekday[6] = this.languageArray.sat;
        return weekday[date_v.getDay()];
    },
    getheaderfooter: function(types,curtime,sloatcnt,displaycurtime)
    {
        divstyle = 'style="display:none"';
        divstylea = '';
        if (curtime == "")
        {
            displaycurtime = "&nbsp;";
            divstyle="";
            divstylea = 'font-size:28px;';
        }
        if (sloatcnt < 0)
        {
            sloatcnt = 0;
        }
        if (types == "header")
        {
            return '<div id="sloat_'+sloatcnt+'" class="fc-content" '+divstyle+'>\n\
                        <div id="div'+curtime.replace(":","_")+'" class="fc-agenda-axis fc-widget-header fc-first" style="width: 70px;'+divstylea+'">'+displaycurtime+'</div>';
        }
        if (types == "footer")
        {
            return '</div>';
        }
    },
    getCalendarDataa: function(curtimev,jsondata,sloatcnt,displaycurtimev)
    {
        tphtmlcode = '';
        coldatetime = new Date();
        daterange = new Date();
        mm = this.CalendarStartDate.getMonth();
        yy = this.CalendarStartDate.getFullYear();
        dd = this.CalendarStartDate.getDate();
        tt = curtimev.split(":");// + ":00";
        hh = tt[0];
        mi = tt[1];
        ss = "00";
        tmpdate = new Date(yy,mm,dd,hh,mi,ss);
        tttm = parseInt(coldatetime.getTime()) + parseInt((1*24*60*60*1000));
        daterange = new Date(daterange.setTime(tttm));
        pastoneday  = new Date(daterange.setTime(parseInt(coldatetime.getTime()) - parseInt((0*24*60*60*1000))));
	for(c=0;c<7;c=c+1)
        {
            coldatetime = new Date(coldatetime.setTime(parseInt(tmpdate.getTime()) + (c*24*60*60*1000)));
            //console.log("This is inside function : " + coldatetime + " : " + curtimev + " : " + daterange);
            colid = "div"+coldatetime.getFullYear()+"_"+(coldatetime.getMonth()+1)+"_"+coldatetime.getDate()+"_"+coldatetime.getHours()+"_"+coldatetime.getMinutes();
            dbvalue="-1";
            if (this.logintype == "student")
            {
                if (coldatetime > daterange)
                {
                    tphtmlcode = tphtmlcode + '<div id="'+colid+'" class="fc-sun fc-col0 fc-widget-header divdata" style="width: 78px;background-color:'+this.requestslotcolorcode+'; font-size: 14px;" rel="'+c+'">'+this.languageArray.request+'</div>';
                }
                else
                {
                    tphtmlcode = tphtmlcode + '<div id="'+colid+'" class="fc-sun fc-col0 fc-widget-header divdata noselecion" style="width: 78px;background-color:'+this.calculatecolorcode(coldatetime,dbvalue,colid,'','')+'; font-size: 14px;" rel="'+c+'">'+this.languageArray.closed+'</div>';                    
                }
            }
            else
            {
                
            }
        }
        tphtmlcode = this.getheaderfooter("header",curtimev,sloatcnt,displaycurtimev) + tphtmlcode + this.getheaderfooter("footer","",0,displaycurtimev);
        //console.log(tphtmlcode);
        return tphtmlcode;
    },
    getCalendarData: function(curtimev,jsondata,sloatcnt,displaycurtimev)
    {
        tphtmlcode = '';
        coldatetime = new Date();
        daterange = new Date();
	//console.log(this.CalendarStartDate);
        //console.log(this.CalendarStartDate.getDate() + "display calender date for calulation");
        mm = this.CalendarStartDate.getMonth();
        yy = this.CalendarStartDate.getFullYear();
        dd = this.CalendarStartDate.getDate();
        tt = curtimev.split(":");// + ":00";
        hh = tt[0];
        mi = tt[1];
        ss = "00";
        //console.log(this.CalendarStartDate + " : " + mm + " : " + yy + " : " + dd + " : " + tt);
        //dtt = new Date(yy,mm,dd);
        //console.log(dtt);
        //dtt = new Date(yy,mm,dd,hh,mi,ss);
        //console.log(dtt);
        //tmpdate = new Date(this.CalendarStartDate.getFullYear(),(this.CalendarStartDate.getMonth()+1),this.CalendarStartDate.getDate(),curtimev + ":00");
        tmpdate = new Date(yy,mm,dd,hh,mi,ss);
	//console.log(tmpdate + " : " + curtimev);
	//tttm = parseInt(coldatetime.getTime()) + parseInt((1*24*60*60*1000));
        tttm = parseInt(coldatetime.getTime()) + parseInt((12*60*60*1000));
        daterange = new Date(daterange.setTime(tttm));
        pastoneday  = new Date(daterange.setTime(parseInt(coldatetime.getTime()) - parseInt((0*24*60*60*1000))));
	//console.log( " : daterange : " + daterange + " : " + coldatetime.getTime() + " : " + coldatetime.getTime() + (1*24*60*60*1000)); 
        for(c=0;c<7;c=c+1)
        {
            coldatetime = new Date(coldatetime.setTime(parseInt(tmpdate.getTime()) + (c*24*60*60*1000)));
            //console.log("This is inside function : " + coldatetime + " : " + curtimev + " : " + daterange);
            colid = "div"+coldatetime.getFullYear()+"_"+(coldatetime.getMonth()+1)+"_"+coldatetime.getDate()+"_"+coldatetime.getHours()+"_"+coldatetime.getMinutes();
            dbvalue="-1";
            if (coldatetime > daterange)
            {
		//console.log("greater");
                if (this.logintype == "student")
                {
                    tphtmlcode = tphtmlcode + '<div id="'+colid+'" class="fc-sun fc-col0 fc-widget-header divdata" style="width: 78px;background-color:'+this.requestslotcolorcode+'; font-size: 14px;" rel="'+c+'">'+this.languageArray.request+'</div>';
                }
                else
                {
                    tphtmlcode = tphtmlcode + '<div id="'+colid+'" class="fc-sun fc-col0 fc-widget-header divdata" style="width: 78px;background-color:'+this.calculatecolorcode(coldatetime,dbvalue,colid,'','')+'; font-size: 14px;" rel="'+c+'">'+this.languageArray.open+'</div>';
                }
            }
            else
            { 
                /*if (coldatetime > pastoneday)
                {
                    //tphtmlcode = tphtmlcode + '<div id="'+colid+'" class="fc-sun fc-col0 fc-widget-header divdata noselecion" style="width: 78px;background-color:'+this.calculatecolorcode(coldatetime,dbvalue,colid,'','')+'; font-size: 14px;" rel="'+c+'">'+this.languageArray.closed+'a</div>';
                    if (this.logintype == "student")
                    {
                        tphtmlcode = tphtmlcode + '<div id="'+colid+'" class="fc-sun fc-col0 fc-widget-header divdata classpasttime" style="width: 78px;background-color:'+this.defaultcolorcode+'; font-size: 14px;" rel="'+c+'">'+this.languageArray.closed+'a</div>';
                    }
                    else
                    {
                        tphtmlcode = tphtmlcode + '<div id="'+colid+'" class="fc-sun fc-col0 fc-widget-header divdata classpasttime" style="width: 78px;background-color:'+this.calculatecolorcode(coldatetime,dbvalue,colid,'PastTime','')+'; font-size: 14px;" rel="'+c+'">'+this.languageArray.closed+'b</div>';
                    }
                }
                else*/
                {
                    //console.log("lesser");
                    tphtmlcode = tphtmlcode + '<div id="'+colid+'" class="fc-sun fc-col0 fc-widget-header divdata noselecion" style="width: 78px;background-color:'+this.calculatecolorcode(coldatetime,dbvalue,colid,'','')+'; font-size: 14px;" rel="'+c+'">'+this.languageArray.closed+'</div>';
                }
            }
        }
        tphtmlcode = this.getheaderfooter("header",curtimev,sloatcnt,displaycurtimev) + tphtmlcode + this.getheaderfooter("footer","",0,displaycurtimev);
        //console.log(tphtmlcode);
        return tphtmlcode;
    },
    generatetime: function()
    {
        //tmpdate = new Date('2013,02,02');
		tmpdate = new Date();//Date('2013,02,02');
		mm = tmpdate.getMonth() + 1;
		yy = tmpdate.getFullYear();
		dd = tmpdate.getDate();
		//console.log(tmpdate.getMonth() + " : " + mm + " : " + yy + " : " + dd);
		tmpdate = new Date(yy,mm,dd);
        curtime = tmpdate;
        startingtime = tmpdate.getHours();
        //console.log("This is code : " + tmpdate + " : " + startingtime);
        tphtmlcode = '';
        //console.log(tphtmlcode);
        //dbdata = this.dbprocess(this.CalendarStartDate,this.CalendarEndDate,'');
        freetimercnt = -1;
        cnt = 0;
        for(cc=0;cc<48;cc=cc+1)
        {
            if (cc == 0)
            {
                curtime = new Date(curtime.setTime(curtime.getTime() + (0)));
            }
            else
            {
                curtime = new Date(curtime.setTime(curtime.getTime() + (30 * 60 * 1000)));
            }
            //console.log(curtime);
            if ((curtime.getHours()) >= this.dayfreetime)
            {
                //console.log("testtest" + curtime.getHours());
                if (freetimercnt == -1)
                {
                    tphtmlcode = tphtmlcode + this.addgapslots(cc,cnt,1);
                    freetimercnt = 0;  
                    cnt = cnt + 1;
                }
                if ((freetimercnt) == (this.timeslotrange))
                {
                    //console.log("test");
                    tphtmlcode = tphtmlcode + this.addgapslots(cc,cnt,1);
                    freetimercnt = 0;
                    cnt = cnt + 1;
                }
                freetimercnt = freetimercnt + 1;
            }
            tphtmlcode = tphtmlcode + this.getCalendarData(this.formattime(curtime),'',cc,this.displayformattime(curtime));
        }
        //tphtmlcode = this.getheaderfooter("header",this.formattime(curtime)) + tphtmlcode + this.getheaderfooter("footer");
        tphtmlcode = tphtmlcode + this.addgapslots(cc,cnt,-1);
        return tphtmlcode
    },
    addgapslots: function(freetimercnt,cnt_v,displaytype)
    {
        if (displaytype == -1)
        {
            c = '<div id="divfull_'+cnt+'" class="brak-line fulldiv" style="display:none;">';
        }
        else
        {
            c = '<div id="divfull_'+cnt+'" class="brak-line fulldiv">';
        }
        tit = "";
        if ((cnt+1) == 1)
        {
            tit = '<div style="float:left;font-size: 16px;width: 100px; padding-top:2px; color:#fff;">'+this.languageArray.morning+'</div>';
        }
        else
        {
            if ((cnt+1) == 2)
            {
                tit = '<div style="float:left;font-size: 16px;width: 100px; padding-top:2px; color:#fff;">'+this.languageArray.afternoon+'</div>';
            }
            else
            {
                if ((cnt+1) == 3)
                {
                    tit = '<div style="float:left;font-size: 16px;width: 100px; padding-top:2px; color:#fff;">'+this.languageArray.night+'</div>';
                }
            }
        }
        if (cnt_v > -1)
        {
            c = c + '<input type="hidden" id="hdn_start_sloat_'+cnt_v+'" value="'+freetimercnt+'">';
        }
        if (cnt_v > 0)
        {
            c = c + '<input type="hidden" id="hdn_end_sloat_'+(cnt_v - 1)+'" value="'+(freetimercnt - 1)+'">';
        }
        c = c + '<img id="show_'+cnt_v+'" src="'+this.base_url+'images/mycalendar/down.png" class="slotshow slotshowhide'+(cnt+1)+'">';
        c = c + '<img id="hide_'+cnt_v+'" src="'+this.base_url+'images/mycalendar/up.png" class="slothide slotshowhide'+(cnt+1)+'" style="display:none;">&nbsp;'+tit+'</div>';
        return c;  
    },
    formattime: function(date_v)
    {
        h = date_v.getHours();
        m = date_v.getMinutes();
        if (h.toString().length == 1)
        {
            h = "0".toString()+h.toString();
        }
        if (m.toString().length == 1)
        {
            m = "0".toString()+m.toString();
        }
        return h + ":" + m + "";
    },
    displayformattime: function(date_v)
    {
        h = date_v.getHours();
        m = date_v.getMinutes();
        f = "AM";
        if (h<12)
        {
            f = "AM";
        }
        else
        {
            f = "PM";
            //h = h - 12;
        }
        if (h>12)
        {
            h = h - 12;
        }
        if (h.toString().length == 1)
        {
            h = "0".toString()+h.toString();
        }
        if (m.toString().length == 1)
        {
            m = "0".toString()+m.toString();
        }
        return h + ":" + m + " " + f;
    },
    midcalculatecolorcode: function()
    {
        coldatetime = new Date();
        daterange = new Date();
        daterangepast = new Date();
        coldatetime_a = new Date();
        daterange = new Date(daterange.setTime(coldatetime.getTime() + (0*24*60*60*1000)));
        //daterangepast = new Date(daterangepast.setTime(coldatetime.getTime() + (1*24*60*60*1000)));
        daterangepast = new Date(daterangepast.setTime(coldatetime.getTime() + (12*60*60*1000)));
        coldatetime = new Date(coldatetime.setTime(parseInt(daterange.getTime())));
        tmpmin = coldatetime.getMinutes();
        if (tmpmin < 30)
        {
            tmpmin = "30";
        }
        else
        {
            tmpmin = "00";
        }
        colid = "div"+coldatetime.getFullYear()+"_"+(coldatetime.getMonth()+1)+"_"+coldatetime.getDate()+"_"+coldatetime.getHours()+"_"+tmpmin;
        //alert("test"+colid);
        newdate = new Date();
        for(c=0;c<49;c=c+1)
        {
            //
            newdate = new Date(newdate.setTime(coldatetime.getTime() + (c*(30*60*1000))));
            coldatetime_a = new Date(coldatetime_a.setTime(parseInt(newdate.getTime())));
            tmpmin = coldatetime_a.getMinutes();
            if (tmpmin < 30)
            {
                tmpmin = "0";
            }
            else
            {
                tmpmin = "30";
            }
            colid = "div"+coldatetime_a.getFullYear()+"_"+(coldatetime_a.getMonth()+1)+"_"+coldatetime_a.getDate()+"_"+coldatetime_a.getHours()+"_"+tmpmin;
           // console.log(colid+'hiren');
            if (!($("#"+colid).hasClass("classpasttime")))
            {
                if (c < 28 || ($("#"+colid).html() == "Request" || $("#"+colid).html() == "Requested") || $("#"+colid).html() == "Open" || $("#"+colid).html() == "Book")
                {
                    $("#"+colid).html("Closed");
                    $("#"+colid).addClass("classpasttime");
                    $("#"+colid).css("background-Color",this.pastimecode);
                }
            }
        }
    },
    calculatecolorcode: function(celldatetime,dbvalue,divid_v,ttidv,tabletype)
    {
		//console.log(" dbvalue : " + dbvalue);
        if (dbvalue != "-1")
        {
            //console.log(celldatetime.getTime() + " : " + new Date().getTime() + " : " + new Date());
        }
        coldatetime = new Date();
        daterange = new Date();
        daterangepast = new Date();
        daterange = new Date(daterange.setTime(coldatetime.getTime() + (0*24*60*60*1000)));
        daterangepast = new Date(daterangepast.setTime(coldatetime.getTime() + (1*24*60*60*1000)));
	daterangepast = new Date(daterangepast.setTime(coldatetime.getTime() + (12*60*60*1000)));
        //console.log(" : " + daterange + " : " + coldatetime.getTime() + " : " + (1*24*60*60*1000));
        if (celldatetime.getTime() < daterange.getTime())
        {
            /*if (celldatetime.getTime() < daterangepast.getTime())
            {
                return "#FF0000";
            }
            else*/
            {
                //return "#FF0000";//this.pastimecode;
                //alert("test");
                return this.pastimecode;
            }
        }
        else
        {
            //return "#000000";
            //console.log(dbvalue);
            if (dbvalue == "-1")
            {
		//console.log(" : " + this.defaultcolorcode);
                if (celldatetime.getTime() < daterangepast.getTime())
                {
                    //alert("test"+divid_v+":"+daterangepast.getTime()+":"+celldatetime.getTime());
                    $(divid_v).addClass("classpasttime");
                    $(divid_v).html("Closed");
                    $(divid_v).css("background-Color",this.pastimecode);
                    return this.pastimecode;
                }
                else
                {
                    return this.defaultcolorcode;
                }
            }
            else
            {
                if(dbvalue == "0")
                {
                    if (celldatetime.getTime() < daterangepast.getTime())
                    {
                        //alert("test"+divid_v+":"+daterangepast.getTime()+":"+celldatetime.getTime());
                        $(divid_v).addClass("classpasttime");
                        $(divid_v).html("Closed");
                        $(divid_v).css("background-Color",this.pastimecode);
                        return this.pastimecode;
                    }
                    else
                    {
                        if (this.logintype == "student")
                        {
                            $(divid_v).html(this.languageArray.book);
                        }
                        else
                        {
                            $(divid_v).html(this.languageArray.open);
                        }
                        return this.freeslotcode;
                    }
                }
                else
                {
                    if (tabletype == "timeSlot")
                    {
                        if (celldatetime.getTime() < daterangepast.getTime())
                        {
                            //alert("test"+divid_v+":"+daterangepast.getTime()+":"+celldatetime.getTime());
                            $(divid_v).addClass("classpasttime");
                            $(divid_v).html("Closed");
                            $(divid_v).css("background-Color",this.pastimecode);
                            return this.pastimecode;
                        }
                        else
                        {
                            if (this.logintype == "student")
                            {
                                $(divid_v).html(this.languageArray.requested);

                                $(divid_v).addClass("noselecion");
                                return this.requestedslotcolorcode;
                            }
                            else
                            {
                                $(divid_v).html(this.languageArray.confirm);
                                $(divid_v).removeClass("noselecion");
                                return this.confirmslotcolorcode;
                            }
                        }
                    }
                    else
                    {
                        //$(divid_v).html(this.languageArray.booked + "test");
                        if (celldatetime.getTime() < daterangepast.getTime())
                        {
                            //alert("test"+divid_v+":"+daterangepast.getTime()+":"+celldatetime.getTime());
                            $(divid_v).addClass("classpasttime");
                            $(divid_v).html(this.languageArray.booked);
                        }
                        else
                        {
                            $(divid_v).html(this.languageArray.booked);
                            $(divid_v).addClass("noselecion");
                            //console.log(divid_v);
                        }
                        return this.bookslotcode;
                    }
                }
            }
        }
    },
    bindelement: function()
    {
        newdate = new Date();
        //console.log(newdate.getHours() + " : " + newdate.getMinutes());
        curtimes = "#div";
        if (newdate.getHours() < 10)
        {
            curtimes = curtimes+"0"+newdate.getHours();
        }
        else
        {
            curtimes = curtimes+newdate.getHours()
        }
        if (newdate.getMinutes() < 30)
        {
            curtimes = curtimes+"_00";
        }
        else
        {
            curtimes = curtimes+"_30";
        }
        //console.log(curtimes);
		//console.log($(curtimes).parent().attr("id") + "asdasdasd");
        tmpid = ($(curtimes).parent(".fc-content").attr("id"));
        //pid = $("#"+tmpid).prevAll(".brak-line:first").css("background-color","#ffffff");//.children(".slotshow").attr("id");
        pid = $("#"+tmpid).prevAll(".brak-line:first").attr("id");//.children(".slotshow").attr("id");
        //console.log("test a");
		//if (typeof(pid) != "undefined")
		//{
			//console.log(pid + " : " + tmpid);
		//}
		//else
		//{
			//console.log("testtest");
		//}
        $("#pasttime").bind("click",function(){ 
            $("#technocalendar").html("");
            newdate = new Date(newdate.setTime(Project.modules.customcalendar.CalendarStartDate.getTime() - ((6)*24*60*60*1000)));
            //console.log(newdate);
            //console.log(JSON.stringify(Project.modules.customcalendar.languageArray));
            var coded = Project.modules.customcalendar.mycalendersetting(Project.modules.customcalendar.divcalendar,newdate,Project.modules.customcalendar.base_url,Project.modules.customcalendar.logintype,Project.modules.customcalendar.additionalprofileid,JSON.stringify(Project.modules.customcalendar.languageArray),0,Project.modules.customcalendar.uid);
             
            //$("#technocalendar").html(coded);
            //$("#"+Project.modules.customcalendar.slot_0_isopen).trigger("click");
            //$("#"+Project.modules.customcalendar.slot_1_isopen).trigger("click");
            //$("#"+Project.modules.customcalendar.slot_2_isopen).trigger("click");
            //$("#divfull_0").trigger("click");
            //$("#divfull_1").trigger("click");
            //$("#divfull_2").trigger("click");
		 
            if (Project.modules.customcalendar.slot_0_isopen != "0")
            {
                if (Project.modules.customcalendar.slot_0_isopen == "none")
                {
                    $("#show_0").css("display","none");
                    $("#hide_0").css("display","block");
                }
                else
                {
                    $("#show_0").css("display","block");
                    $("#hide_0").css("display","none");
                }
                Project.modules.customcalendar.showhide("divfull_0",0);
            }
            if (Project.modules.customcalendar.slot_1_isopen != "0")
            {
                if (Project.modules.customcalendar.slot_1_isopen == "none")
                {
                    $("#show_1").css("display","none");
                    $("#hide_1").css("display","block");
                }
                else
                {
                    $("#show_1").css("display","block");
                    $("#hide_1").css("display","none");
                }
                Project.modules.customcalendar.showhide("divfull_1",0);
            }
            if (Project.modules.customcalendar.slot_2_isopen != "0")
            {
                if (Project.modules.customcalendar.slot_2_isopen == "none")
                {
                    $("#show_2").css("display","none");
                    $("#hide_2").css("display","block");
                }
                else
                {
                    $("#show_2").css("display","block");
                    $("#hide_2").css("display","none");
                }
                Project.modules.customcalendar.showhide("divfull_2",0);
            }
            tdate = Project.modules.customcalendar.CalendarStartDate;
            $("#current_month_no").val(tdate.getMonth()+1);
            $("#current_year_no").val(tdate.getFullYear());
            $("#current_month_name").val(Project.modules.customcalendar.getmonthname(tdate.getMonth()));
        });
        $("#comingtime").bind("click",function(){ 
            $("#technocalendar").html("");
            newdate = new Date(newdate.setTime(Project.modules.customcalendar.CalendarEndDate.getTime() + ((6)*24*60*60*1000)));
            //console.log(newdate);
            //console.log(Project.modules.customcalendar.slot_0_isopen);
            //console.log(Project.modules.customcalendar.slot_1_isopen);
            //console.log(Project.modules.customcalendar.slot_2_isopen);
            var coded = Project.modules.customcalendar.mycalendersetting(Project.modules.customcalendar.divcalendar,newdate,Project.modules.customcalendar.base_url,Project.modules.customcalendar.logintype,Project.modules.customcalendar.additionalprofileid,JSON.stringify(Project.modules.customcalendar.languageArray),0,Project.modules.customcalendar.uid);
            //console.log(Project.modules.customcalendar.slot_0_isopen);
            //console.log(Project.modules.customcalendar.slot_1_isopen);
            //console.log(Project.modules.customcalendar.slot_2_isopen);
            console.log(coded);
            //$("#technocalendar").html(coded);
            //$("#"+Project.modules.customcalendar.slot_0_isopen).trigger("click");
            //$("#"+Project.modules.customcalendar.slot_1_isopen).trigger("click");
            //$("#"+Project.modules.customcalendar.slot_2_isopen).trigger("click");
            //$("#divfull_01").trigger("click");
            //$("#divfull_11").trigger("click");
             
			if (Project.modules.customcalendar.slot_0_isopen != "0")
            {
                if (Project.modules.customcalendar.slot_0_isopen == "none")
                {
                    $("#show_0").css("display","none");
                    $("#hide_0").css("display","block");
                }
                else
                {
                    $("#show_0").css("display","block");
                    $("#hide_0").css("display","none");
                }
                Project.modules.customcalendar.showhide("divfull_0",0);
            }
            if (Project.modules.customcalendar.slot_1_isopen != "0")
            {
                if (Project.modules.customcalendar.slot_1_isopen == "none")
                {
                    $("#show_1").css("display","none");
                    $("#hide_1").css("display","block");
                }
                else
                {
                    $("#show_1").css("display","block");
                    $("#hide_1").css("display","none");
                }
                Project.modules.customcalendar.showhide("divfull_1",0);
            }
            if (Project.modules.customcalendar.slot_2_isopen != "0")
            { 
                if (Project.modules.customcalendar.slot_2_isopen == "none")
                {
                    $("#show_2").css("display","none");
                    $("#hide_2").css("display","block");
                }
                else
                {
                    $("#show_2").css("display","block");
                    $("#hide_2").css("display","none");
                }
                Project.modules.customcalendar.showhide("divfull_2",0);
            }
            //console.log(Project.modules.customcalendar.CalendarStartDate);
            tdate = Project.modules.customcalendar.CalendarStartDate;
            $("#current_month_no").val(tdate.getMonth()+1);
            $("#current_year_no").val(tdate.getFullYear());
            $("#current_month_name").val(Project.modules.customcalendar.getmonthname(tdate.getMonth()));
        });
        /*$(".slotshow").bind("click",function(){
            if (this.id == "show_0" || this.id == "hide_0")
            {
                Project.modules.customcalendar.slot_0_isopen = this.id;
            }
            if (this.id == "show_1" || this.id == "hide_1")
            {
                Project.modules.customcalendar.slot_1_isopen = this.id;
            }
            if (this.id == "show_2" || this.id == "hide_2")
            {
                Project.modules.customcalendar.slot_2_isopen = this.id;
            }
            startingid = ($("#"+(this.id).replace("show_","hdn_start_sloat_")).val())*1;
            endingid = ($("#"+(this.id).replace("show_","hdn_end_sloat_")).val())*1;
            for (cnt = startingid;cnt <= endingid; cnt = cnt + 1)
            {
                $("#sloat_"+cnt).show();
            }
            $("#"+(this.id).replace("show_","hide_")).show();
            $("#"+(this.id)).hide();
        });
        $(".slothide").bind("click",function(){
            if (this.id == "show_0" || this.id == "hide_0")
            {
                Project.modules.customcalendar.slot_0_isopen = this.id;
            }
            if (this.id == "show_1" || this.id == "hide_1")
            {
                Project.modules.customcalendar.slot_1_isopen = this.id;
            }
            if (this.id == "show_2" || this.id == "hide_2")
            {
                Project.modules.customcalendar.slot_2_isopen = this.id;
            }
            startingid = ($("#"+(this.id).replace("hide_","hdn_start_sloat_")).val())*1;
            endingid = ($("#"+(this.id).replace("hide_","hdn_end_sloat_")).val())*1;
            //console.log(startingid + " : " + endingid);
            for (cnt = startingid;cnt <= endingid; cnt = cnt + 1)
            {
                $("#sloat_"+cnt).hide();
            }
            $("#"+(this.id).replace("hide_","show_")).show();
            $("#"+(this.id)).hide();
        });*/
        //console.log("test");
        $(".divdata").bind("click",function(){	
		
		var text = $(this).text();
		
		if(text=="Booked" || text=="Closed" || text == "Requested" || $(this).hasClass("classpasttime"))
		{
			return false;
		}
		var User=$('#UserType').val();
		/* Added By Ilyas */
		/*var UniversalUser=$('#universal_roleId').val();
		// End 

		if(User>=1 && UniversalUser==0) // Updated By Ilyas
		{
			 alert(Project.modules.customcalendar.languageArray.youMustHave);
			return false;
		}*/
		
		
		var Is_school=$('#Isschool').val();
		  v = $('#conversationtopic option:selected').val();
						
						l = $('#sspeakinglevel option:selected').val();				 
							 if(Is_school > 0  /*&& l !='naval'*/ && v != -1)
								{
									$('#dialog1').dialog({
										modal:true,
										width:'430px',
										resizable:false,
										beforeclose: function( event, ui ) {closeFunc();return false;}
										});
										count=1;
								}
					//return false; 
					
            cc = $("#"+this.id).css("background-color");
			divid = this.id;
            console.log(cc);
            console.log(divid + " : " + Project.modules.customcalendar.logintype + "student" + Project.modules.customcalendar.additionalprofileid);
            divcol = Project.modules.customcalendar.codeconvertionrgb2hex(cc);
            divaction = "add";
			if (Project.modules.customcalendar.logintype == "student" && Project.modules.customcalendar.additionalprofileid == 0)
            {
				console.log("This is a");
                return false;
            }
            if ((Project.modules.customcalendar.additionalprofileid*1) > 0)
            {
				var userid=Project.modules.customcalendar.uid;
				
				if(userid=='')
				{
					$('#dialog').attr('buttonType','doing');
					$('#dialog').dialog({modal:true});
					$('#dialog').attr('buttonType','done');
					$('#dialog').html('You must login or register first.');
					$( ".floating_form" ).show();
					return false;
				}
				
                //console.log("a");
                console.log("divcol : " + divcol);
                if (divcol == (Project.modules.customcalendar.freeslotcode).toLowerCase())
                { 
					v = $('#conversationtopic option:selected').val();
						
						l = $('#sspeakinglevel option:selected').val();
					/*if(l =='naval')
					{
					   alert(Project.modules.customcalendar.languageArray.speakLeval);
                                           //console.log("testae");
                                           window.scrollTo(500,250);
					   return false;
					}
					else */
					if (v == -1)
                    {
                            alert(Project.modules.customcalendar.languageArray.selecttopic);
                            $("#conversationtopic").focus();
                            //console.log("testaf");
                            window.scrollTo(500,250);
                            return false;
                        }
						else{}
						if(Is_school > 0)
						{
					$('#rateButton12').click(function(){
					$('#dialog1').dialog('close');
					 BookByStudent();
					});
					}else {BookByStudent();}
				}
                else
                {  
				v = $('#conversationtopic option:selected').val();
						
				l = $('#sspeakinglevel option:selected').val();
				
				 
				var Is_school=$('#Isschool').val();
				 
					/*if(l =='naval')
					{
					   alert(Project.modules.customcalendar.languageArray.speakLeval);
                                           //console.log("testae");
                                           window.scrollTo(500,250);
					   return false;
					}
					else */
					if (v == -1)
                    {
                            alert(Project.modules.customcalendar.languageArray.selecttopic);
                            $("#conversationtopic").focus();
                            //console.log("testaf");
                            window.scrollTo(500,250);
                            return false;
                        }
						else{}
									
									if(Is_school > 0)
									{ 
									$('#rateButton12').click(function(){
										$('#dialog1').dialog('close');
										RequestByStudent();
										});
										}
										else{
										RequestByStudent();
										}
				}
            }
            else
            {
				
                console.log(" : " + divcol);
				console.log(" a : " + Project.modules.customcalendar.pastimecode + " b : " + Project.modules.customcalendar.bookslotcode + " c : " + Project.modules.customcalendar.freeslotcode + " d : " + Project.modules.customcalendar.confirmslotcolorcode);
                if (divcol == (Project.modules.customcalendar.pastimecode).toLowerCase())
                {
                    return false;
                }
                else
                {
                    if (divcol == (Project.modules.customcalendar.bookslotcode).toLowerCase())
                    {
                        return false;
                    }
                    else
                    {
                        if (divcol == (Project.modules.customcalendar.defaultcolorcode).toLowerCase())
                        {
                            divaction = "add";
                        }
                        else
                        {
                            if (divcol == (Project.modules.customcalendar.freeslotcode).toLowerCase())
                            {
                                divaction = "delete";
                            }
                            else
                            {
                                if (divcol == (Project.modules.customcalendar.confirmslotcolorcode).toLowerCase())
                                {
                                    //alert("test");
                                    if (confirm(Project.modules.customcalendar.languageArray.confirmsession))
                                    {
                                        divaction = "confirm";
                                    }
                                    else
                                    {
                                        divaction = "";
                                        return false;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            //console.log("test");
            //console.log(divaction + " : " + divcol + " : " + (Project.modules.customcalendar.freeslotcode).toLowerCase());
			console.log(this.id + " : " + divaction);
            Project.modules.customcalendar.generatedata(this.id,divaction);
        });
        $("#conversationtopic").bind("change",function(){
            v = $('#conversationtopic option:selected').val();
            $("#txtconversationtopic").hide();
            if (v == 0)
            {
                $("#txtconversationtopic").show();
            }
        });
       $("#divfull_0").bind("click", function(){
			console.log("This is test");
            pid = this.id;
            //console.log(pid);
            if ($("#"+pid.replace("divfull","show")).css("display") == "none")
            {
                $("#"+pid.replace("divfull","show")).show();
                $("#"+pid.replace("divfull","hide")).hide();
            }
            else
            {
                $("#"+pid.replace("divfull","show")).hide();
                $("#"+pid.replace("divfull","hide")).show();
            }
            Project.modules.customcalendar.showhide(pid,1);
            /*iid = "";
            //if ($(this).children("#show_0:first").css("display") == "block")
            if (Project.modules.customcalendar.slot_0_isopen == "hide_0")
            {
                Project.modules.customcalendar.slot_0_isopen = "show_0";
                iid = "show_0";
                startingid = ($("#"+(iid).replace("show_","hdn_start_sloat_")).val())*1;
                endingid = ($("#"+(iid).replace("show_","hdn_end_sloat_")).val())*1;
                //console.log(startingid + " : " + endingid);
                for (cnt = startingid;cnt <= endingid; cnt = cnt + 1)
                {
                    $("#sloat_"+cnt).show();
                }
                $("#"+(iid).replace("show_","hide_")).show();
                $("#"+(iid)).hide();
            }
            else
            {
                Project.modules.customcalendar.slot_0_isopen = "hide_0";
                iid = "hide_0";
                startingid = ($("#"+(iid).replace("hide_","hdn_start_sloat_")).val())*1;
                endingid = ($("#"+(iid).replace("hide_","hdn_end_sloat_")).val())*1;
                //console.log(startingid + " : " + endingid);
                for (cnt = startingid;cnt <= endingid; cnt = cnt + 1)
                {
                    $("#sloat_"+cnt).hide();
                }
                $("#"+(iid).replace("hide_","show_")).show();
                $("#"+(iid)).hide();
            }*/
            //console.log(Project.modules.customcalendar.slot_0_isopen);
            //console.log(iid);
            //$("#"+iid).trigger("click");
            /*if (this.id == "show_0" || this.id == "hide_0")
            {
                Project.modules.customcalendar.slot_0_isopen = this.id;
            }
            if (this.id == "show_1" || this.id == "hide_1")
            {
                Project.modules.customcalendar.slot_1_isopen = this.id;
            }
            if (this.id == "show_2" || this.id == "hide_2")
            {
                Project.modules.customcalendar.slot_2_isopen = this.id;
            }*/
            //$(this).toggleClass("showhide");
            //Project.modules.customcalendar.showhide(this.id);
        });
        $("#divfull_1").click(function(){
            pid = this.id;
            console.log(pid);
            if ($("#"+pid.replace("divfull","show")).css("display") == "none")
            {
                $("#"+pid.replace("divfull","show")).show();
                $("#"+pid.replace("divfull","hide")).hide();
            }
            else
            {
                $("#"+pid.replace("divfull","show")).hide();
                $("#"+pid.replace("divfull","hide")).show();
            }
            Project.modules.customcalendar.showhide(pid,1);
            /*iid = "";
            //console.log($(this).children("#show_1:first").css("display"));
            //if ($(this).children("#show_1:first").css("display") == "block")
            if (Project.modules.customcalendar.slot_1_isopen == "hide_1")
            {
                Project.modules.customcalendar.slot_1_isopen = "show_1";
                iid = "show_1";
                startingid = ($("#"+(iid).replace("show_","hdn_start_sloat_")).val())*1;
                endingid = ($("#"+(iid).replace("show_","hdn_end_sloat_")).val())*1;
                //console.log(startingid + " : " + endingid);
                for (cnt = startingid;cnt <= endingid; cnt = cnt + 1)
                {
                    $("#sloat_"+cnt).show();
                }
                $("#"+(iid).replace("show_","hide_")).show();
                $("#"+(iid)).hide();
            }
            else
            {
                Project.modules.customcalendar.slot_1_isopen = "hide_1";
                iid = "hide_1";
                startingid = ($("#"+(iid).replace("hide_","hdn_start_sloat_")).val())*1;
                endingid = ($("#"+(iid).replace("hide_","hdn_end_sloat_")).val())*1;
                //console.log(startingid + " : " + endingid);
                for (cnt = startingid;cnt <= endingid; cnt = cnt + 1)
                {
                    $("#sloat_"+cnt).hide();
                }
                $("#"+(iid).replace("hide_","show_")).show();
                $("#"+(iid)).hide();
            }*/
            //console.log(Project.modules.customcalendar.slot_1_isopen);
            //$(this).toggleClass("showhide");
            //Project.modules.customcalendar.showhide(this.id);
        });
        $("#divfull_2").bind("click", function(){
            pid = this.id;
            //console.log(pid);
            if ($("#"+pid.replace("divfull","show")).css("display") == "none")
            {
                $("#"+pid.replace("divfull","show")).show();
                $("#"+pid.replace("divfull","hide")).hide();
            }
            else
            {
                $("#"+pid.replace("divfull","show")).hide();
                $("#"+pid.replace("divfull","hide")).show();
            }
            Project.modules.customcalendar.showhide(pid,1);
        });
        //console.log(Project.modules.customcalendar.slot_0_isopen + " : " + Project.modules.customcalendar.slot_1_isopen + " : " + Project.modules.customcalendar.slot_2_isopen + " : " + pid);
        /*if (Project.modules.customcalendar.slot_2_isopen == "0")
        {
            console.log("test");
            if (pid == "divfull_21")
            {
                Project.modules.customcalendar.slot_2_isopen = "hide_2";
                $("#"+pid).trigger("click");
            }
        }
        //console.log(Project.modules.customcalendar.slot_0_isopen + " : " + Project.modules.customcalendar.slot_1_isopen + " : " + Project.modules.customcalendar.slot_2_isopen + " : " + pid);*/
		//console.log("test"+pid);
		//pid = this.id;
        if (typeof(pid) != "undefined")
		{
			console.log('up to here');	
			$("#"+pid.replace("divfull","show")).hide();
			$("#"+pid.replace("divfull","hide")).show();
			Project.modules.customcalendar.showhide(pid,0);
		}
    },
    dbprocess: function(divid){
        //console.log(divid);
        url_v = this.base_url+'getSlotData.html'; 
        data = "startdate="+startdate+"&enddate="+enddate+"&diviid="+divid;
        $.ajax({
            type: "POST",
            url: url_v,
            data: data,
            dataType: "json",
            success: function(data){
                //console.log(data);
            }
        });
    },
    generatedata: function(divid_v,divaction_v) {
		//console.log("This is generatedata : " + divid_v + " : " + divaction_v);
        url_v = this.base_url+'getSlotData.html'; 
		//url_v = '/dev.thetalklist.com/'+'getSlotData.html';
        data = "startdate="+this.CalendarStartDate+"&enddate="+this.CalendarEndDate+"&d="+new Date();
        data =  data+"&logintype="+Project.modules.customcalendar.logintype;
        data =  data+"&divaction="+divaction_v;
        data =  data+"&additionalprofileid="+Project.modules.customcalendar.additionalprofileid;
        var User=$('#UserType').val();
		 
		if (divid_v.length > 0)
        {
           data =  data+"&diviid="+divid_v;
        }
		//console.log(data + " : " + url_v);
        $.ajax({
            type: "POST",
            url: url_v,
            data: data,
            dataType: "json",
            //async: true,
            success: function(data){;
				
				//console.log(data.querytype + " : " + data.result + " : " + data.qy);
                if (data.querytype == "select")
                {
                    $.each(data.result,function(rowdata){
                        //console.log(data[rowdata].divid);
                        dividv = "#div"+data.result[rowdata].divid;
                        stidv = data.result[rowdata].stid;
                        ttidv = data.result[rowdata].uid;
                        tabletype = data.result[rowdata].tabletype;
                        divtime = new Date(data.result[rowdata].startTime);
                        //console.log(dividv);
                        $(dividv).css("background-color",Project.modules.customcalendar.calculatecolorcode(divtime,stidv,dividv,ttidv,tabletype));
                    });
                    Project.modules.customcalendar.midcalculatecolorcode();
                }
                else
                {
					 
                    if (data.querytype == "insert" && data.result > 0 && User !=0)
                    {
                        $("#"+divid_v).css("background-color",Project.modules.customcalendar.freeslotcode);
                    }
                    else
                    {
                        if (data.querytype == "delete" && data.result > 0)
                        {
                            $("#"+divid_v).css("background-color",Project.modules.customcalendar.defaultcolorcode);
                        }
                        else
                        {
                            if (data.querytype == "confirm" && data.result > 0)
                            {
                                $("#"+divid_v).css("background-color",Project.modules.customcalendar.bookslotcode);
                                $("#"+divid_v).html(Project.modules.customcalendar.languageArray.booked);
								window.location.href = Project.modules.customcalendar.base_url + "user/calendar";
                                //alert("test");
                                $("#"+divid_v).addClass("noselecion");
                            }
                        }
                    }
                }
            },
            complete: function() {
                //console.log("a :::::");
                //if (divid_v.length > 0)
                //{
                    //console.log("test"+" : " + divid_v+" : " + divaction+" : " + Project.modules.customcalendar.defaultcolorcode);
                //    if (divaction == "add")
                //    {
                //        $("#"+divid_v).css("background-color",Project.modules.customcalendar.freeslotcode);
                //    }
                //    else
                //    {
                //        $("#"+divid_v).css("background-color",Project.modules.customcalendar.defaultcolorcode);
                //    }
                    //Project.modules.customcalendar.generatedata(0,'GetAll')
                //}
            }
        });
    },
    codeconvertionrgb2hex: function(rgb) {
        rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
        return (rgb && rgb.length === 4) ? "#" +
         ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
         ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
         ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
    },
    conversationtopicfromdbs: function ()
    {
        url_v = this.base_url+'getconversationtopic.html';
        data =  "";
        $.ajax({
            type: "POST",
            url: url_v,
            data: data,
            dataType: "html",
            success: function(data) {
               //console.log(data); 
               //$("#conversationtopic_container").html(data.p2);
               $("#conversationtopic").html(data);
            }
        });
    },
    showhide: function(divdivid,valuechange)
    {
        console.log(divdivid + " : " + valuechange);
        var showhidetype = $("#"+divdivid.replace("divfull_","show_")).css("display");
        if (valuechange != 0)
        {
            if (divdivid == "divfull_0")
            {
                Project.modules.customcalendar.slot_0_isopen = showhidetype;
            }
            if (divdivid == "divfull_1")
            {
                Project.modules.customcalendar.slot_1_isopen = showhidetype;
            }
            if (divdivid == "divfull_2")
            {
                Project.modules.customcalendar.slot_2_isopen = showhidetype;
            }
        }
        console.log(showhidetype);
        if (showhidetype == "none")
        { 
            iid = divdivid.replace("divfull_","show_");
            startingid = ($("#"+(iid).replace("show_","hdn_start_sloat_")).val())*1;
            endingid = ($("#"+(iid).replace("show_","hdn_end_sloat_")).val())*1;
           // console.log(startingid + " : " + endingid);
           /* for (cnt = startingid;cnt <= endingid; cnt = cnt + 1)
            {
                $("#sloat_"+cnt).show();
            } */
			
			for(cnt=0; cnt<=47;cnt = cnt + 1)
			{
				$("#sloat_"+cnt).show();
			}
			// $("#show_0").css("display","block");
            //$("#"+(iid).replace("show_","hide_")).show();
            //$("#"+(iid)).hide();
        }
        else
        {
            iid = divdivid.replace("divfull_","hide_");
            startingid = ($("#"+(iid).replace("hide_","hdn_start_sloat_")).val())*1;
            endingid = ($("#"+(iid).replace("hide_","hdn_end_sloat_")).val())*1;
            //console.log(startingid + " : " + endingid);
            for (cnt = startingid;cnt <= endingid; cnt = cnt + 1)
            {
                $("#sloat_"+cnt).hide();
            }
            //$("#"+(iid).replace("hide_","show_")).show();
            //$("#"+(iid)).hide();
        }
    },
    getmonthname: function(monthno)
    {
        var month = new Array();
        month[0] = "January";
        month[1] = "February";
        month[2] = "March";
        month[3] = "April";
        month[4] = "May";
        month[5] = "June";
        month[6] = "July";
        month[7] = "August";
        month[8] = "September";
        month[9] = "October";
        month[10] = "November";
        month[11] = "December";
        return month[monthno];
    },
    pagerefresh: function()
    { 
        
        $("#technocalendar").html("");
        newdate = new Date(newdate.setTime(this.CalendarEndDate.getTime() + ((0)*24*60*60*1000)));
        var coded = this.mycalendersetting(this.divcalendar,newdate,this.base_url,this.logintype,this.additionalprofileid,JSON.stringify(this.languageArray),0,this.uid);
		 
	   if (this.slot_0_isopen != "0")
        {
            if (this.slot_0_isopen == "none")
            {
                $("#show_0").css("display","none");
                $("#hide_0").css("display","block");
            }
            else
            {
                $("#show_0").css("display","block");
                $("#hide_0").css("display","none");
            }
            this.showhide("divfull_0",0);
        } 
        if (this.slot_1_isopen != "0")
        {
            if (this.slot_1_isopen == "none")
            {
                $("#show_1").css("display","none");
                $("#hide_1").css("display","block");
            }
            else
            {
                $("#show_1").css("display","block");
                $("#hide_1").css("display","none");
            }
            this.showhide("divfull_1",0);
        }
        if (this.slot_2_isopen != "0")
        {
            if (this.slot_2_isopen == "none")
            {
                $("#show_2").css("display","none");
                $("#hide_2").css("display","block");
            }
            else
            {
                $("#show_2").css("display","block");
                $("#hide_2").css("display","none");
            }
            this.showhide("divfull_2",0);
        }
        tdate = this.CalendarStartDate;
        $("#current_month_no").val(tdate.getMonth()+1);
        $("#current_year_no").val(tdate.getFullYear());
        $("#current_month_name").val(this.getmonthname(tdate.getMonth()));
    },
    getdateformated: function(dividp)
    {
        tdividp = dividp.split("_");
        //console.log(tdividp);
        dt = new Date((tdividp[0].replace("div","")) + " " + tdividp[1] + " " + tdividp[2] + " " + tdividp[3]+":"+ tdividp[4]);
        dtt = (tdividp[0].replace("div","")) + "-" + tdividp[1] + "-" + tdividp[2] + " " + this.displayformattime(dt);
        //console.log(dt);
        //console.log(dtt);
        return dtt;
    },
    getdateformatednew: function(dividp)
    {
        tdividp = dividp.split("_");
        //console.log(tdividp);
        dt = new Date((tdividp[0].replace("div","")) + " " + tdividp[1] + " " + tdividp[2] + " " + tdividp[3]+":"+ tdividp[4]);
        tdt = tdividp[1];
        if (tdividp[1].length == 1)
        {
            tdt = "0"+tdividp[1];
        }
        tdta = tdividp[2];
        if (tdividp[2].length == 1)
        {
            tdta = "0"+tdividp[2];
        }
        dtt = (tdividp[0].replace("div","")) + "-" + tdt + "-" + tdta + " at  " + this.displayformattime(dt);
        //console.log(dt);
        //console.log(dtt);
        return dtt;
    }
};
$(function() {
    Project.init();
    $(document).ready(function() {
    });
});
function BookByStudent()
{
	 
					//if book
                    //console.log("Popup");
                    //$("#divcourseselection").show();
                    v = $('#conversationtopic option:selected').val();
					l = $('#sspeakinglevel option:selected').val();
						
					/*if(l =='naval')
					{
					   alert(Project.modules.customcalendar.languageArray.speakLeval);
                                           //console.log("testab");
                                           window.scrollTo(500,250);
					   return false;
					}
					else */
					if (v == -1)
                    {
                        alert(Project.modules.customcalendar.languageArray.selecttopic);
                        $("#conversationtopic").focus();
                        //$(window).scrollTop($("teacher_prof_Wp").offset().top);
                        //$("tempscroll").scrollIntoView(true);
                        //console.log("testac");
                        window.scrollTo(500,250);
                        return false;
                    }
                    else
                    {
                        if (v == 0 && $("#txtconversationtopic").val() == "Demo")
                        {
                            alert(Project.modules.customcalendar.languageArray.selecttopictext);
                            $("#txtconversationtopic").focus();
                            //console.log("testad");
                            window.scrollTo(500,250);
                            return false;
                        }
                        else
                        {
                            /* call this function addSlotTimebyst(),buyClasses,buyClassesbytutor for adding booking detail*/
                            /* check this addClass,checkClassBookNow,checkClass */
						
						    confirmdata = Project.modules.customcalendar.languageArray.bookslot;
                            newdt = Project.modules.customcalendar.getdateformatednew(divid);
                            confirmdata = confirmdata.replace("#DateTime#",newdt);
						
 
							var SesssionTypeH=$('input[name=amex]:checked').val();
							
                           // alert(confirmdata);
                            cost = "0.00";
                            //console.log($("#hdnschooltutorcost").val());
                            if (SesssionTypeH == 1)
                            {
                                /*if ($("#hdnschooltutorcost").val() == "-1")
                                {
                                    alert("Not related with school\n this is not from database");
                                    return false;
                                }
                                else
                                {*/
                                    cost = $("#hdnschooltutorcost").val();
                                //}
                            }
                            else
                            {
                                cost = $("#hdntutorcost").val();
                            }
							
								pbal=$("#pbalance").val();
								isaffi1=$("#isaffi").val();
								type=SesssionTypeH;
								 
								if(pbal <=10 && isaffi1=='1' && type=='1')
								{
								    alert('Your school does not have enough credit, please select Conversation to continue.');
									return false;
								}
								/*if(isaffi1 == 0 && type == '1')
								{
									alert('You are not associated with this Tutor’s School Community.  You may book a conversation session with this tutor at the listed price or you may pick another school community tutor.');
									window.location.href = Project.modules.customcalendar.base_url + "search/search";
									return false;
								}*/
                            confirmdata = confirmdata.replace("#cost#",cost);
							if (confirm(confirmdata))
                            {
                                url_v = Project.modules.customcalendar.base_url+'buyClasses.html';
                                sspeakinglevelv = $("#sspeakinglevel  option:selected").val();
                                conversationtopicv = $('#conversationtopic option:selected').text();
                                txtconversationtopicv = $("#txtconversationtopic").val();
                                SessionCostv = $("#hdncost").val();
								var SesssionTypeH=$('input[name=amex]:checked').val();
                                data = "diviid="+divid+"&tutorid="+Project.modules.customcalendar.additionalprofileid+"&sspeakinglevel="+sspeakinglevelv+"&conversationtopic="+conversationtopicv+"&txtconversationtopic="+txtconversationtopicv+"&bookingtype="+SesssionTypeH+"&isrequest=0&SessionCost="+SessionCostv;
							
                                //data = "diviid="+divid+"&tutorid="+Project.modules.customcalendar.additionalprofileid+"&sspeakinglevel="+sspeakinglevelv+"&conversationtopic="+conversationtopicv+"&txtconversationtopic="+txtconversationtopicv+"&bookingtype="+$("#hdnSessionType").val()+"&isrequest=0&SessionCost="+SessionCostv;
                                $.ajax({
                                    type: "POST",
                                    url: url_v,
                                    data: data,
                                    dataType: "json",
                                    success: function(data){
                                        //console.log(data);
                                        //console.log(divid);
                                        if(data.success)
                                        {
                                            $("#"+divid).css("background-color",Project.modules.customcalendar.bookslotcode);
                                            $("#"+divid).addClass("noselecion");
                                            $("#"+divid).html("Booked");
                                            //Project.modules.customcalendar.conversationtopicfromdbs();
                                            $("#txtconversationtopic").val("");
                                            $("#hdnisnew").val(data.isnew);
                                            $("#hdntutorcost").val(data.tutorcost);
                                            $("#hdnschooltutorcost").val(data.schooltutorcost);
                                            if (data.msg == 'freesession')
                                            {
                                                mssg = Project.modules.customcalendar.languageArray.freesession;
                                            }
                                            if (data.msg == 'successrequest')
                                            {
                                                mssg = Project.modules.customcalendar.languageArray.successrequest;
                                            }
                                            if (data.msg == 'successbooking')
                                            {
                                                mssg = Project.modules.customcalendar.languageArray.successbooking;
                                            }
                                          //  alert((mssg).replace("#amt#",data.cost));
										  
										  
											//alert('');
											var checkFree=$('#isFreesession').val();
											if(checkFree =='NO')
											{ 
												$('#confDialog').dialog({
															modal:true,
														width:'200px'
													});
											
											}
											else
												{ 
											 
													window.location.href = Project.modules.customcalendar.base_url + "user/calendar/uid/" + Project.modules.customcalendar.uid;
												}											
                                        }
                                        else
                                        {
                                            mssg = "";
                                            if (data.msg == 'nopermission')
                                            {
                                                mssg = Project.modules.customcalendar.languageArray.nopermission;
												alert((mssg).replace("#amt#",data.cost));
                                            }
                                            if (data.msg == 'firstlogin')
                                            {
                                                mssg = Project.modules.customcalendar.languageArray.firstlogin;
												alert((mssg).replace("#amt#",data.cost));
                                            }
                                            if (data.msg == 'enoughmoney')
                                            {
                                                mssg = Project.modules.customcalendar.languageArray.enoughmoney;
												alert((mssg).replace("#amt#",data.cost));
                                            }
											 if (data.msg.indexOf("incompleteprofile") >= 0)
											 {
												alert(data.msg.replace("incompleteprofile",""));
												window.location.href = Project.modules.customcalendar.base_url + "user/registerEdit";
											 }
                                            //alert("mssg");
                                            
                                            if (data.msg == 'enoughmoney')
                                            {
                                                window.location.href = Project.modules.customcalendar.base_url + "user/account/uid/" + Project.modules.customcalendar.uid;
                                            }
                                        }
                                    }
                                });
								callback(false);
                            }else{callback(false); }
                        }
                    }
                    return false;
                
}
function RequestByStudent()
{   	 	 
					if (divcol == (Project.modules.customcalendar.requestslotcolorcode).toLowerCase())
                    {
                        //console.log("Class request");
                        //$("#divcourseselection").show();
                        v = $('#conversationtopic option:selected').val();
						
						l = $('#sspeakinglevel option:selected').val();
					/*if(l =='naval')
					{
					   alert(Project.modules.customcalendar.languageArray.speakLeval);
                                           //console.log("testae");
                                           window.scrollTo(500,250);
					   return false;
					}
					else */
					if (v == -1)
                    {
                            alert(Project.modules.customcalendar.languageArray.selecttopic);
                            $("#conversationtopic").focus();
                            //console.log("testaf");
                            window.scrollTo(500,250);
                            return false;
                        }
                        else
                        {
                            if (v == 0 && $("#txtconversationtopic").val() == "Demo")
                            {
                                alert(Project.modules.customcalendar.languageArray.selecttopictext);
                                $("#txtconversationtopic").focus();
                                //console.log("testaa");
                                window.scrollTo(600,250);
                                return false;
                            }
                            else
                            {
                                //alert("test");
								var SesssionTypeH=$('input[name=amex]:checked').val();
								
								confirmdata = Project.modules.customcalendar.languageArray.requestslot;
                                newdt = Project.modules.customcalendar.getdateformatednew(divid);
                                confirmdata = confirmdata.replace("#DateTime#",newdt);
                                //alert(confirmdata + " : " + newdt);
                                cost = "0.00";
                                if (SesssionTypeH == 1)
                                {
                                    /*if ($("#hdnschooltutorcost").val() == "-1")
                                    {
                                        alert("Not related with school\n this is not from database");
                                        return false;
                                    }
                                    else
                                    {*/
                                        cost = $("#hdnschooltutorcost").val();
                                    //}
                                }
                                else
                                {
                                    cost = $("#hdntutorcost").val();
                                }
								pbal=$("#pbalance").val();
								isaffi1=$("#isaffi").val();
								type=SesssionTypeH;
								 
								if(pbal <=10 && isaffi1=='1' && type=='1')
								{
								    alert('Your school does not have enough credit, please select Conversation to continue.');
									return false;
								}
								/*if(isaffi1 == 0 && type == '1')
								{
									alert('You are not associated with this Tutor’s School Community.  You may book a conversation session with this tutor at the listed price or you may pick another school community tutor.');
									window.location.href = Project.modules.customcalendar.base_url + "search/search";
									return false;
								}*/
                                confirmdata = confirmdata.replace("#cost#",cost);
                                //confirmdata.replace("#DateTime#",)
								 if (confirm(confirmdata))
                                {  
                                    url_v = Project.modules.customcalendar.base_url+'buyClasses.html';
                                    sspeakinglevelv = $("#sspeakinglevel  option:selected").val();
                                    conversationtopicv = $('#conversationtopic option:selected').text();
                                    txtconversationtopicv = $("#txtconversationtopic").val();
                                    SessionCostv = $("#hdncost").val();
									var SesssionTypeH=$('input[name=amex]:checked').val();
                                    data = "diviid="+divid+"&tutorid="+Project.modules.customcalendar.additionalprofileid+"&sspeakinglevel="+sspeakinglevelv+"&conversationtopic="+conversationtopicv+"&txtconversationtopic="+txtconversationtopicv+"&bookingtype="+SesssionTypeH+"&isrequest=1&SessionCost="+SessionCostv+"&isaffi="+isaffi1;									
									 
                                    //data = "diviid="+divid+"&tutorid="+Project.modules.customcalendar.additionalprofileid+"&sspeakinglevel="+sspeakinglevelv+"&conversationtopic="+conversationtopicv+"&txtconversationtopic="+txtconversationtopicv+"&bookingtype="+$("#hdnSessionType").val()+"&isrequest=1&SessionCost="+SessionCostv;
									//data = "diviid="+divid+"&tutorid="+Project.modules.customcalendar.additionalprofileid+"&sspeakinglevel="+sspeakinglevelv+"&conversationtopic="+conversationtopicv+"&txtconversationtopic="+txtconversationtopicv+"&bookingtype="+$("#stype  option:selected").val()+"&isrequest=1&SessionCost="+SessionCostv+"&isaffi="+isaffi+;
                                    $.ajax({
                                        type: "POST",
                                        url: url_v,
                                        data: data,
                                        dataType: "json",
                                        success: function(data){
                                            console.log(data);
                                            //console.log(divid);
											  
                                            if(data.success)
                                            {
                                                $("#"+divid).css("background-color",Project.modules.customcalendar.requestedslotcolorcode);
                                                $("#"+divid).addClass("noselecion");
                                                $("#"+divid).html(Project.modules.customcalendar.languageArray.requested);
                                                //Project.modules.customcalendar.conversationtopicfromdbs();
                                                $("#txtconversationtopic").val("");
                                                $("#hdnisnew").val(data.isnew);
                                                $("#hdntutorcost").val(data.tutorcost);
                                                $("#hdnschooltutorcost").val(data.schooltutorcost);
                                            }
                                            else
                                            {
                                                //alert(data.msg);
                                                if (data.msg == 'enoughmoney')
                                                {
                                                    mssg = Project.modules.customcalendar.languageArray.enoughmoney;
                                                }
                                                //alert("mssg");
												
                                                //alert((mssg).replace("#amt#",data.cost));
                                                if (data.msg == 'enoughmoney')
                                                {
													alert('You do not have enough money. Please purchase credits to book this tutor.');
                                                    window.location.href = Project.modules.customcalendar.base_url + "user/account/uid/" + Project.modules.customcalendar.uid;
                                                }
												 if (data.msg == 'You must login first!')
												 {
													alert("You must login first!");
												 }
												 if (data.msg.indexOf("incompleteprofile") >= 0)
												 {
													alert(data.msg.replace("incompleteprofile",""));
													window.location.href = Project.modules.customcalendar.base_url + "user/registerEdit";
												 }
                                            }
                                        }
                                    });
									 callback(false);
									 
                                }
								else{ 
								callback(false);
								}
                            }
                        }
                        
						return false;
                    }
                    else
                    { 
                        return false;
                    }
                
}