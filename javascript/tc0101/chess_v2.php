<?php
/*
 * Copyright 2006 SitePoint Pty. Ltd, www.sitepoint.com
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *   http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

define('NEW_GAME', '{"lastMove":{"movePiece": null,"takePieceId":null,"moveTime":null},"pieceList":{"black_r2":{"color":"black","id":"black_r2","pos":[7,7],"origPos":[]},"black_p1":{"color":"black","id":"black_p1","pos":[6,0],"origPos":[]},"black_p2":{"color":"black","id":"black_p2","pos":[6,1],"origPos":[]},"black_p3":{"color":"black","id":"black_p3","pos":[6,2],"origPos":[]},"black_p4":{"color":"black","id":"black_p4","pos":[6,3],"origPos":[]},"black_p5":{"color":"black","id":"black_p5","pos":[6,4],"origPos":[]},"black_p6":{"color":"black","id":"black_p6","pos":[6,5],"origPos":[]},"black_p7":{"color":"black","id":"black_p7","pos":[6,6],"origPos":[]},"black_p8":{"color":"black","id":"black_p8","pos":[6,7],"origPos":[]}}}');

require_once "JSON.php";

$json = new Services_JSON();
$input = implode("\r\n", file('php://input'));
$cmd = $json->decode($input);
$game = Game::instance();
$resp = new Response();
$out = '';

switch ($cmd->cmdName) {
  case 'load':
    $out = '{"respStatus":"ok", "respData":'.$game->getFromFile().'}';
    break;
  case 'wipe':
    $game->saveToFile(NEW_GAME);
    $out = '{"respStatus":"ok", "respData":'.NEW_GAME.'}';
    break;
  case 'poll':
    $lastMove = $cmd->cmdData;
    $game->load();
    if (($game->state->lastMove->moveTime > $lastMove->moveTime)||
      ($lastMove->moveTime && !$game->state->lastMove->moveTime)) {
      $out = '{"respStatus":"update", "respData":'.getGame().'}';
    }
    else {
      $resp->respStatus = 'nochange';
      $out = $json->encode($resp);
    }
    break;
  case 'move':  
    $move = $cmd->cmdData;
    $movePieceId = $move->movePiece->id;
    $takePieceId = $move->takePieceId;
    $moveTime = strftime('%Y-%m-%d %T', time());
    $game->load();
    $game->state->pieceList->$movePieceId->pos[0] = $move->movePiece->pos[0];
    $game->state->pieceList->$movePieceId->pos[1] = $move->movePiece->pos[1];
    if ($takePieceId) {
      unset($game->state->pieceList->$takePieceId);
    }
    $game->state->lastMove->movePiece = $move->movePiece;
    $game->state->lastMove->moveTime = $moveTime;
    $game->state->lastMove->takePieceId = $takePieceId;
    $resp->respStatus = 'ok';
    $resp->respData->lastMove = $game->state->lastMove;
    $out = $json->encode($resp);
    $game->save();
    break;
}
header('Content-Type: text/plain');
print $out;

// to provide function in PHP 4.4x - CLL from http://us2.php.net/manual/en/function.file-put-contents.php
function file_put_contents($n,$d) {
  $f=@fopen($n,"w");
  if (!$f) {
   return false;
  } else {
   fwrite($f,$d);
   fclose($f);
   return true;
  }
}

class Game {
  function Game() {
    $this->json = new Services_JSON();
    $this->state = new GameState();
    $this->filePath = 'chessboard.txt';
  }
  function saveToFile($str) {
    if (is_writable($this->filePath)) {
      file_put_contents($this->filePath, $str) or die('Could not write to file '.$this->filePath);
    }
    else {
      die('File is not writable');
    }
  }
  function getFromFile() {
    if (is_readable($this->filePath)) {
      $str = file_get_contents($this->filePath) or die('Could not get file contents from '.$this->filePath);
      return $str;
    }
    else {
      die('File '.$this->filePath.' is not readable');
    }
  }
  function load() {
    $str = $this->getFromFile();
    $this->state = $this->json->decode($str);
  }
  function save() {
    $str = $this->json->encode($this->state);
    $this->saveToFile($str);
  }
  function instance() {
    static $instance = null;
    if($instance === null) {
      $instance = new Game();
    }
    return $instance;
  }
}

class Response {
  function Response($respStatus = '', $respData = '') {
    $this->respStatus = $respStatus;
    $this->respData = $respData;
  }
}

class GameState {
  function GameState($lastMove = null, $pieceList = null) {
    $this->lastMove = $lastMove;
    $this->pieceList = $pieceList;
  }
}

?>