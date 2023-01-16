import uuid

from django.db import models
from django.db.models.signals import post_save
from localisation.models import Delegation, Departement, Village
from plantation.signals.parcelle_signal import parcelPiedCreationSignal
from utilisateur.models import Producteur


class Parcelle(models.Model):
    class Meta:
        db_table = "tb_parcelle"

    id = models.BigIntegerField( blank=True, default=0)
    code_parcelle = models.CharField(primary_key=True,max_length=30, unique=True, blank=True, default="")
    uuid = models.UUIDField(unique=True, blank=True, default=None)
    qr_code = models.TextField(blank=True, default="")
    nom_parcelle = models.CharField(max_length=50,null=true)
    longitude = models.FloatField(max_length=30)
    latitude = models.FloatField(max_length=30)
    etat_parcelle = models.IntegerField(default=1)
    variete = models.CharField(max_length=30, default='', blank=True,null=true)
    mode_aquisition = models.CharField(max_length=50, default='', blank=True,null=true)
    observation_variete = models.TextField(default="", blank=True,null=true)
    superficie = models.CharField(max_length=15,null=true)
    type_plantation = models.CharField(max_length=15, default="cacao",null=true)
    production_annuelle = models.FloatField(blank=True, default=0,null=true)
    axe = models.CharField(max_length=50, default=0, blank=True,null=true)
    code_prod = models.ForeignKey(Producteur, on_delete=models.DO_NOTHING,
                                              blank=True, default=0, related_name="parcelles")
    delegation = models.ForeignKey(Delegation, on_delete=models.DO_NOTHING, related_name="parcelledelegations")
    delegation_code = models.CharField(max_length=30, blank=True, default=None)
    departement = models.ForeignKey(Departement, on_delete=models.DO_NOTHING, related_name="parcelledepartements")
    departement_code = models.CharField(max_length=30, blank=True, default=None)
   sous_prefecture = models.ForeignKey(Sous_prefecture, on_delete=models.DO_NOTHING, related_name="parcelleSous_prefecture")
    code_sous_prefecture = models.CharField(max_length=30, blank=True, default=None)
    village_code = models.CharField(max_length=30, default=None, blank=True)
    village = models.ForeignKey(Village, blank=True, default=None, on_delete=models.DO_NOTHING,
                                related_name="parcellevillages")
    annnee_creation = models.CharField(max_length=4,default='', blank=True, null=true)
    parcelleeliminer = models.CharField(max_length=100, db_column='parcelle_eliminer',default="", blank=True)
    active = models.IntegerField(default=1, help_text="ce champs peut avoir que trois valeur -1 0 1")
    supp = models.IntegerField(default=0,help_text="ce champs peut avoir que 2 valeur 1 0 ")
    id_supp = models.IntegerField(default=0, blank=True, null=true)
    id_modification = models.IntegerField(default=0, blank=True, null=true)
    id_enregistrement = models.IntegerField(default=0, blank=True)

    date_creation = models.DateTimeField(auto_now_add=True, editable=False, null=true)
    date_modification = models.DateTimeField(auto_now=True, null=true)
    date_destruction = models.DateTimeField(auto_now=True, null=true)
    date_suppression = models.DateTimeField(auto_now=False, auto_created=False, default='', blank=True, null=true)

    def __str__(self):
        return "parcelle {0} {1}".format(self.type_parcelle, self.nom_parcelle)

    def save(self, *args, **kwargs):

        if self.id is None or self.id == 0:
            try:
                self.id = Parcelle.objects.latest('id').id + 1
            except Parcelle.DoesNotExist:
                self.id = 1
            pk = "K{0:04d}".format(self.id)
            if self.type_parcelle.lower() == "cafe" or self.type_parcelle.lower() == 'cafes':
                pk = "C{0:04d}".format(self.id)
            self.code_parcelle = pk

        if self.uuid is None:
            try:
                self.uuid = uuid.uuid4()
            except Exception as e:
                self.uuid = uuid.uuid4()

        super(Parcelle, self).save()


post_save.connect(parcelPiedCreationSignal, sender=Parcelle)
