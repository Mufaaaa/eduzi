<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Komunitas;
use App\Models\KomentarKomunitas;
use App\Models\LikeKomunitas;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KomunitasUnitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Menguji relasi Komunitas ke User.
     */
    public function test_komunitas_belongs_to_user()
    {
        $user = User::factory()->create();

        $komunitas = Komunitas::create([
            'user_id' => $user->id,
            'isi' => 'Postingan komunitas',
        ]);

        $this->assertInstanceOf(
            User::class,
            $komunitas->user
        );

        $this->assertEquals(
            $user->id,
            $komunitas->user->id
        );
    }

    /**
     * Menguji relasi Komunitas memiliki banyak komentar.
     */
    public function test_komunitas_has_many_comments()
    {
        $komunitas = Komunitas::factory()->create();

        KomentarKomunitas::create([
            'komunitas_id' => $komunitas->id,
            'user_id' => User::factory()->create()->id,
            'isi' => 'Komentar 1',
        ]);

        KomentarKomunitas::create([
            'komunitas_id' => $komunitas->id,
            'user_id' => User::factory()->create()->id,
            'isi' => 'Komentar 2',
        ]);

        $this->assertCount(
            2,
            $komunitas->fresh()->komentar
        );
    }

    /**
     * Menguji relasi Komunitas memiliki banyak likes.
     */
    public function test_komunitas_has_many_likes()
    {
        $komunitas = Komunitas::factory()->create();

        LikeKomunitas::create([
            'user_id' => User::factory()->create()->id,
            'komunitas_id' => $komunitas->id,
        ]);

        LikeKomunitas::create([
            'user_id' => User::factory()->create()->id,
            'komunitas_id' => $komunitas->id,
        ]);

        LikeKomunitas::create([
            'user_id' => User::factory()->create()->id,
            'komunitas_id' => $komunitas->id,
        ]);

        $this->assertCount(
            3,
            $komunitas->fresh()->likes
        );
    }

    /**
     * Menguji relasi komentar ke user.
     */
    public function test_comment_belongs_to_user()
    {
        $user = User::factory()->create();

        $komunitas = Komunitas::factory()->create();

        $komentar = KomentarKomunitas::create([
            'komunitas_id' => $komunitas->id,
            'user_id' => $user->id,
            'isi' => 'Komentar test',
        ]);

        $this->assertInstanceOf(
            User::class,
            $komentar->user
        );

        $this->assertEquals(
            $user->id,
            $komentar->user->id
        );
    }

    /**
     * Menguji relasi reply komentar.
     */
    public function test_comment_reply_to_user()
    {
        $user = User::factory()->create();

        $replyUser = User::factory()->create();

        $komunitas = Komunitas::factory()->create();

        $komentar = KomentarKomunitas::create([
            'komunitas_id' => $komunitas->id,
            'user_id' => $user->id,
            'reply_to_user_id' => $replyUser->id,
            'isi' => 'Reply komentar',
        ]);

        $this->assertEquals(
            $replyUser->id,
            $komentar->replyTo->id
        );
    }

    /**
     * Menguji relasi LikeKomunitas ke Komunitas.
     */
    public function test_like_belongs_to_komunitas()
    {
        $user = User::factory()->create();

        $komunitas = Komunitas::factory()->create();

        $like = LikeKomunitas::create([
            'user_id' => $user->id,
            'komunitas_id' => $komunitas->id,
        ]);

        $this->assertEquals(
            $komunitas->id,
            $like->komunitas->id
        );
    }

    /**
     * Menguji fillable Komunitas.
     */
    public function test_komunitas_fillable_attributes()
    {
        $model = new Komunitas();

        $this->assertEquals([
            'user_id',
            'isi',
            'guest_identifier',
        ], $model->getFillable());
    }

    /**
     * Menguji fillable KomentarKomunitas.
     */
    public function test_komentar_fillable_attributes()
    {
        $model = new KomentarKomunitas();

        $this->assertEquals([
            'komunitas_id',
            'user_id',
            'reply_to_user_id',
            'isi',
            'guest_identifier',
        ], $model->getFillable());
    }

    /**
     * Menguji fillable LikeKomunitas.
     */
    public function test_like_fillable_attributes()
    {
        $model = new LikeKomunitas();

        $this->assertEquals([
            'user_id',
            'komunitas_id',
            'komentar_id',
            'guest_identifier',
        ], $model->getFillable());
    }
}