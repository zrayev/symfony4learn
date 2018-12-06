<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends AbstractController
{
    private const STATUS_LEAD = 1;
    private const STATUS_NOT_SET = 0;

    private $blogData = [
        'test-post1' => [
            'id' => '1',
            'title' => 'Test post1',
            'slug' => 'test-post1',
            'text' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.',
            'img' => 'img/symfony.png',
            'status' => self::STATUS_NOT_SET,
            'published_at' => 1543770412,
        ],
        'test-post2' => [
            'id' => '2',
            'title' => 'Test post 2',
            'slug' => 'test-post2',
            'text' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.',
            'img' => 'img/symfony.png',
            'status' => self::STATUS_NOT_SET,
            'published_at' => 1443742412,
        ],
        'test-post3' => [
            'id' => '3',
            'title' => 'Test post 3',
            'slug' => 'test-post3',
            'text' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.',
            'img' => 'img/symfony.png',
            'status' => self::STATUS_LEAD,
            'published_at' => 1543767210,
        ],
        'test-post4' => [
            'id' => '4',
            'title' => 'Test post 4',
            'slug' => 'test-post4',
            'text' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.',
            'img' => 'img/symfony.png',
            'status' => self::STATUS_NOT_SET,
            'published_at' => 1521770412,
        ],
        'test-post5' => [
            'id' => '5',
            'title' => 'Test post 5',
            'slug' => 'test-post5',
            'text' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.',
            'img' => 'img/symfony.png',
            'status' => self::STATUS_NOT_SET,
            'published_at' => 1443770412,
        ],
        'test-post6' => [
            'id' => '6',
            'title' => 'Test post 6',
            'slug' => 'test-post6',
            'text' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.',
            'img' => 'img/symfony.png',
            'status' => self::STATUS_NOT_SET,
            'published_at' => 1436770412,
        ],
    ];

    /**
     * @return Response
     */
    public function index(): Response
    {
        if (isset($this->blogData)) {
            return $this->render('post/index.html.twig', [
                'articles' => $this->blogData,
                'lead' => $this->getLead(),
            ]);
        }

        return $this->render('post/index.html.twig', [
           'message' => 'Articles not found. You can will create new article.',
        ]);
    }

    /**
     * @param string $slug
     *
     * @return Response
     */
    public function show(string $slug): Response
    {
        if (!isset($this->blogData[$slug])) {
            throw new NotFoundHttpException('Article not found');
        }

        return $this->render('post/show.html.twig', [
            'post' => $this->blogData[$slug],
            'relatedArticles' => $this->getRelatedArticles($slug),
        ]);
    }

    public function view(string $slug): Response
    {
        if (!$slug) {
            throw new NotFoundHttpException('Article not found');
        }

        return $this->render('post/view.html.twig', [
            'slug' => $slug,
        ]);
    }

    /**
     * @param string $slug
     *
     * @return Response
     */
    public function item(string $slug): Response
    {
        if (!isset($this->blogData[$slug])) {
            throw new NotFoundHttpException('Article not found');
        }

        return $this->render('post/article-item.html.twig', [
            'post' => $this->blogData[$slug],
        ]);
    }

    /**
     * @param string $slug
     *
     * @return array
     */
    public function getRelatedArticles(string $slug): array
    {
        unset($this->blogData[$slug]);

        return $this->blogData;
    }

    /**
     * @return mixed|null
     */
    public function getLead()
    {
        if (\count($this->blogData) > 0) {
            foreach ($this->blogData as $post) {
                if ($post['status'] === self::STATUS_LEAD) {
                    return $post;
                }
            }
        }

        return null;
    }

    public function new(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            if($post->getSlug() !== null) {
                return $this->redirectToRoute('view_article', [
                    'slug' => $post->getSlug(),
                ]);
            }
        }

        return $this->render('post/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
