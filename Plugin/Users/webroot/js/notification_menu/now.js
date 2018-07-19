$(function() {
 var notifications = new $.ttwNotificationMenu({
        notificationList:{
            anchor:'item',
            offset:'0 15'
        }
 });

 notifications.initMenu({
        depositos:'#depositos',
        ordenpagos:'#ordenpagos',
        pagos:'#pagos'
    });

});

