import uuid

from django.db import models
from django.db.models.signals import pre_save, post_save
from utilisateur.models import Delegation


class Departement(models.Model):
    class Meta:
        db_table = "tb_departement"

    id = models.BigIntegerField( blank=True, default=0)
    uuid = models.UUIDField(unique=True, blank=True, default=None)
    designation = models.CharField(max_length=50, default="", blank=True)
    code_departement = models.CharField(primary_key=True,max_length=50, blank=True, default=None)
     delegation_code = models.ForeignKey(Delegation, on_delete=models.DO_NOTHING,
                                                  blank=True, default=0, related_name="delegations")
    active = models.IntegerField(blank=True, default=1, db_column="statut")
     supp = models.IntegerField(default=0,help_text="ce champs peut avoir que 2 valeur 1 0 ")
    id_supp = models.IntegerField(default=0, blank=True, null=true)
    id_modification = models.IntegerField(default=0, blank=True, null=true)
    id_enregistrement = models.IntegerField(default=0, blank=True)
    date_creation = models.DateTimeField(auto_now_add=True, editable=False, null=true)
    date_modification = models.DateTimeField(auto_now=True, null=true)
    date_destruction = models.DateTimeField(auto_now=True, null=true)
    date_suppression = models.DateTimeField(auto_now=False, auto_created=False, default='', blank=True, null=true)


    def __str__(self):
        return self.designation

    def save(self, *args, **kwargs):
        if self.id is None or self.id ==0:
            try:
                self.id = Delegation.objects.latest('id').id + 1
            except Delegation.DoesNotExist:
                self.id = 1

        if self.uuid is None:
            try:
                self.uuid = uuid.uuid4()
            except Exception as e:
                self.uuid = uuid.uuid4()
                print(e)

        super(Delegation, self).save()


