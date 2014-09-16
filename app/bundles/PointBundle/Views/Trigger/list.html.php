<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic, NP. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
if ($tmpl == 'index')
$view->extend('MauticPointBundle:Trigger:index.html.php');
?>

    <?php if (count($items)): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?php echo $view['translator']->trans('mautic.point.trigger.header.index');?>
                </h3>
            </div>
            <div class="table-responsive scrollable body-white padding-sm page-list">
                    <table class="table table-hover table-striped table-bordered pointtrigger-list">
                        <thead>
                        <tr>
                            <th class="col-pointtrigger-actions"></th>
                            <?php
                            echo $view->render('MauticCoreBundle:Helper:tableheader.html.php', array(
                                'sessionVar' => 'pointtrigger',
                                'orderBy'    => 't.name',
                                'text'       => 'mautic.point.trigger.thead.name',
                                'class'      => 'col-pointtrigger-name',
                                'default'    => true
                            ));

                            echo $view->render('MauticCoreBundle:Helper:tableheader.html.php', array(
                                'sessionVar' => 'pointtrigger',
                                'orderBy'    => 't.description',
                                'text'       => 'mautic.point.trigger.thead.description',
                                'class'      => 'col-pointtrigger-description'
                            ));

                            echo $view->render('MauticCoreBundle:Helper:tableheader.html.php', array(
                                'sessionVar' => 'pointtrigger',
                                'orderBy'    => 't.points',
                                'text'       => 'mautic.point.trigger.thead.points',
                                'class'      => 'col-pointtrigger-points'
                            ));

                            echo "<th class='col-pointtrigger-color'>" . $view['translator']->trans('mautic.point.trigger.thead.color') . '</th>';

                            echo $view->render('MauticCoreBundle:Helper:tableheader.html.php', array(
                                'sessionVar' => 'pointtrigger',
                                'orderBy'    => 't.id',
                                'text'       => 'mautic.point.trigger.thead.id',
                                'class'      => 'col-pointtrigger-id'
                            ));
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td>
                                    <?php
                                    echo $view->render('MauticCoreBundle:Helper:actions.html.php', array(
                                        'item'      => $item,
                                        'edit'      => $permissions['point:triggers:edit'],
                                        'clone'     => $permissions['point:triggers:create'],
                                        'delete'    => $permissions['point:triggers:delete'],
                                        'routeBase' => 'pointtrigger',
                                        'menuLink'  => 'mautic_pointtrigger_index',
                                        'langVar'   => 'point.trigger'
                                    ));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $view->render('MauticCoreBundle:Helper:publishstatus.html.php',array(
                                        'item'       => $item,
                                        'model'      => 'point.trigger'
                                    )); ?>
                                    <a href="<?php echo $view['router']->generate('mautic_pointtrigger_action',
                                        array("objectAction" => "view", "objectId" => $item->getId())); ?>"
                                       data-toggle="ajax">
                                        <?php echo $item->getName(); ?>
                                    </a>
                                </td>
                                <td class="visible-md visible-lg"><?php echo $item->getDescription(); ?></td>
                                <td class="visible-md visible-lg"><?php echo $item->getPoints(); ?></td>
                                <?php
                                $color = $item->getColor();
                                $colorStyle = ($color) ? ' style="background-color: ' . $color . '"' : '';
                                ?>
                                <td<?php echo $colorStyle; ?> class="visible-md visible-lg"></td>
                                <td class="visible-md visible-lg"><?php echo $item->getId(); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="page-footer">
                    <?php echo $view->render('MauticCoreBundle:Helper:pagination.html.php', array(
                        "totalItems"      => count($items),
                        "page"            => $page,
                        "limit"           => $limit,
                        "menuLinkId"      => 'mautic_pointtrigger_index',
                        "baseUrl"         => $view['router']->generate('mautic_pointtrigger_index'),
                        'sessionVar'      => 'pointtrigger'
                    )); ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            <h4><?php echo $view['translator']->trans('mautic.core.noresults.header'); ?></h4>
            <p><?php echo $view['translator']->trans('mautic.core.noresults'); ?></p>
        </div>
    <?php endif; ?>