<div bgcolor="#f6f6f6" style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;width:100%!important;height:100%;margin:0;padding:0">
<table style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;width:100%;margin:0;padding:20px">
    <tbody><tr style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;margin:0;padding:0">
        <td style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;margin:0;padding:0"></td>
        <td bgcolor="#FFFFFF" style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;display:block!important;max-width:600px!important;clear:both!important;margin:0 auto;padding:0;border:1px solid #f0f0f0">
            <div style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;max-width:600px;display:block;margin:0 auto;padding:20px">
                <table style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;width:100%;margin:0;padding:0">
                    <tbody><tr>
                        
                        <td style="text-align:center">
                            <a href="{{url('/')}}" target="_blank">
                                <img src="<?= getStoreSettings('small_logo_image_url') ?>" style="max-height:40px" alt="NubianHearts">
                            </a>
                        </td>
                    </tr>
                    <tr style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;margin:0;padding:0">
                        <td style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;margin:0;padding:0">
                            @if($type == 'profile')
                            <h2 style="text-align:center"><?=$username?> viewed your profile</h2>
                            @elseif($type == 'like')
                            <h2 style="text-align:center"><?=$username?> liked your profile</h2>
                            @else
                            <h2 style="text-align:center"><?=$username?> sent you a message</h2>
                            @endif
<div style="text-align:center">
    <div>
            <div>
                <i></i>
            </div>
            <img style="width:100px" src="<?=$profile?>" alt="<?=$username?>">
        </div>
    
        
    
    <div style="padding:1.5rem 0.5rem">
        <h4>
            <span><?=$username?>, <?=$userAge?></span>
            
                
            
        </h4>
        <p><span><b>Lives in: </b><?=$country?>, <?=$city?></span> </p>
    </div>
</div>        <a href="<?= route('user.profile_view', ['username' => $username]) ?>" style="background-color:indigo;color:white;text-align:center;width:500px;padding:8px;border-radius:10px;text-decoration:none" target="_blank">View Profile</a>

                                                    </td>
                    </tr>
                </tbody></table>
            </div>
        </td>
        <td style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;margin:0;padding:0"></td>
    </tr>
</tbody></table>
    <table style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;width:100%;clear:both!important;margin:0;padding:0"><tbody><tr style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;margin:0;padding:0"><td style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;margin:0;padding:0"></td>
    <td style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;display:block!important;max-width:600px!important;clear:both!important;margin:0 auto;padding:0">
        <div style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;max-width:600px;display:block;margin:0 auto;padding:20px">
            <table style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;width:100%;margin:0;padding:0">
                <tbody><tr style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;margin:0;padding:0">
                    <td align="center" style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;margin:0;padding:0">
                        <p style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:12px;line-height:1.6;color:#666;font-weight:normal;margin:0 0 10px;padding:0">
                            Unsubscribe from email alerts <a href="<?= route('user.notification.read.view') ?>" style="background-color:#2f66b3;color:white;text-align:center;width:500px;padding:8px;border-radius:10px;text-decoration:none" target="_blank">Unsubscribe</a>
                        </p>
                    </td>
                </tr>
            </tbody></table>
        </div>
    </td>
    <td style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;margin:0;padding:0"></td>
    </tr>
</tbody></table>
<table style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;width:100%;clear:both!important;margin:0;padding:0"><tbody><tr style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;margin:0;padding:0"><td style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;margin:0;padding:0"></td>
    <td style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;display:block!important;max-width:600px!important;clear:both!important;margin:0 auto;padding:0">
        <div style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;max-width:600px;display:block;margin:0 auto;padding:20px">
            <table style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;width:100%;margin:0;padding:0">
                <tbody><tr style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;margin:0;padding:0">
                    <td align="center" style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;margin:0;padding:0">
                        <p style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:12px;line-height:1.6;color:#666;font-weight:normal;margin:0 0 10px;padding:0">
                            © NubianHearts 2021.
                        </p>
                    </td>
                </tr>
            </tbody></table>
        </div>
    </td>
    <td style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6;margin:0;padding:0"></td>
    </tr>
</tbody></table></div>