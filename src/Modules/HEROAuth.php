<?php
namespace OMerz\HeroADM\Modules;
use OMerz\HeroADM\Models\Herotoken;
use Illuminate\Http\Request;
use OMerz\HeroADM\Modules\HEROConfig;
use App\Models\Users;

class HEROAuth {
    public $confs;

    public function __construct(){
        $confs = new HEROConfig();
    }

    public function create($user){
        $ht = null;
        if($ht = Herotoken::find($user->id)){
            $ht->expire_at = $this->microtime_float() + $this->confs("max_session_life", 900000);
            $ht->key = $this->getName(10);
            $ht->save();
        }else{
            if($usn = User::find($user->id)){
                $ht = Herotoken::create([
                    "user_id" => $usn->id,
                    "key" => $this->getName(10),
                    "expire_at" => $this->microtime_float() + $this->confs("max_session_life", 900000),
                ]);
            }
        }
        return $ht->key;
    }

    public function delete($key){
        if($ht = Herotoken::where("key", $key)->first()){
            $ht->delete();
        }
    }

    public function has($key, $userid){
        if($user = User::find($userid)){
            if($ht = Herotoken::where("user_id", $user->id)->where("key", $key)->first()){
                if($ht->expire_at > $this->microtime_float()){
                    return true;
                }
            }
        }

        return false;
    }

    public function check(Request $req){
        return $this->has($req["authKey"], $req["authUser"]);
    }

    public function hasNoAbort($key, $userid){
        if(!$this->has($key, $userid)){
            abort(403, "Unauthorized");
        }
    }

    public function checkNoAbort(Request $req){
        if(!$this->check($req)){
            abort(403, "Unauthorized");
        }
    }

    public function checkIdf(Request $req){
        if($this->has($req["authKey"], $req["authUser"])){
            return User::find($req["authUser"]);
        }else{
            return null;
        }
    }

    public function checkIdfNoAbort(Request $req){
        $resp = $this->checkIdf($req["authKey"], $req["authUser"]);
        if($resp != null){
            return $resp;
        }else{
            abort(403, "Unauthorized");
        }
    }

    public function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    public function getName($n) { 
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
      
        for ($i = 0; $i < $n; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
      
        return $randomString; 
    } 

    public function authorized($role) { 
        return in_array($role, explode("|", $this->confs->get("roles_see_heroadm")));
    } 

    public function authorizedNoAbort($role) { 
        if(!$this->authorized($role)){
            abort(403, "Unauthorized");
        }
    } 

    public function verify(Request $req) { 
        $resp = $this->checkIdf($req);
        if($resp == null) return null;
        $authed = $this->authorized($resp->role);
        if($authed == false) return null;
        return $resp;
    } 

    public function verifyNoAbort(Request $req) { 
        $resp = $this->verify($req);
        if($resp == null){
            abort(403, "Unauthorized");
        }
        return $resp;
    } 
}
