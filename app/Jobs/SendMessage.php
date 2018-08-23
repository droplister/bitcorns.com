<?php

namespace App\Jobs;

use Telegram;
use Log, Throwable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Chat
     *
     * @var string
     */
    protected $chat;

    /**
     * Message
     *
     * @var string
     */
    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message, $chat=null)
    {
        $this->chat = $chat;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try
        {
            $chats = $this->getChats();

            foreach($chats as $chat => $chat_id)
            {
                $this->sendMessage($chat_id);
            }
        }
        catch(Throwable $e)
        {
            Log::error($e->getMessage());
        }
    }

    /**
     * Select Chat(s)
     * 
     * @return array
     */
    private function getChats()
    {
        $chats = [
            'public' => config('bitcorn.public_chat_id'),
            'private' => config('bitcorn.private_chat_id'),
        ];

        // One
        if($this->chat) return [$chats[$this->chat]];

        // All
        return $chats;
    }

    private function sendMessage($chat_id)
    {
        return Telegram::sendMessage([
            'chat_id' => $chat_id, 
            'text' => $this->message,
            'parse_mode' => 'Markdown',
            'disable_notification' => true,
            'disable_web_page_preview' => true,
        ]);
    }
}